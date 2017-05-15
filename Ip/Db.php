<?php namespace Ip; class Db { protected $pdoConnection; protected $tablePrefix; public function __construct($pdo = null) { if ($pdo) { $this->pdoConnection = $pdo; } else { $this->getConnection(); } } public function getConnection() { if ($this->pdoConnection) { return $this->pdoConnection; } $dbConfig = ipConfig()->get('db'); ipConfig()->set('db', null); if (empty($dbConfig)) { throw new \Ip\Exception\Db("Can't connect to database. No connection config found or \\Ip\\Db::disconnect() has been used."); } try { if (array_key_exists('driver', $dbConfig) && $dbConfig['driver'] == 'sqlite') { $dsn = 'sqlite:' . $dbConfig['database']; $this->pdoConnection = new \PDO($dsn); $this->pdoConnection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION); } else { $dsn = 'mysql:host=' . str_replace(':', ';port=', $dbConfig['hostname']); if (!empty($dbConfig['database'])) { $dsn .= ';dbname=' . $dbConfig['database']; } $this->pdoConnection = new \PDO($dsn, $dbConfig['username'], $dbConfig['password']); $this->pdoConnection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION); $dt = new \DateTime(); $offset = $dt->format("P"); $this->pdoConnection->exec("SET time_zone='$offset';"); $this->pdoConnection->exec("SET CHARACTER SET " . $dbConfig['charset']); } } catch (\PDOException $e) { throw new \Ip\Exception($e->getMessage()); } $this->tablePrefix = $dbConfig['tablePrefix']; return $this->pdoConnection; } public function setConnection($connection) { $this->pdoConnection = $connection; } public function disconnect() { $this->pdoConnection = null; } public function fetchValue($sql, $params = array()) { try { $query = $this->getConnection()->prepare($sql . " LIMIT 1"); foreach ($params as $key => $value) { if (is_bool($value)) { $value = $value ? 1 : 0; } $query->bindValue(is_numeric($key) ? $key + 1 : $key, $value); } $query->execute(); $result = $query->fetchColumn(0); return $result === false ? null : $result; } catch (\PDOException $e) { throw new \Ip\Exception\Db($e->getMessage(), $e->getCode(), $e); } } public function fetchRow($sql, $params = array()) { try { $query = $this->getConnection()->prepare($sql . " LIMIT 1"); foreach ($params as $key => $value) { if (is_bool($value)) { $value = $value ? 1 : 0; } $query->bindValue(is_numeric($key) ? $key + 1 : $key, $value); } $query->execute(); $result = $query->fetchAll(\PDO::FETCH_ASSOC); return $result ? $result[0] : null; } catch (\PDOException $e) { throw new \Ip\Exception\Db($e->getMessage(), $e->getCode(), $e); } } public function fetchAll($sql, $params = array()) { try { $query = $this->getConnection()->prepare($sql); foreach ($params as $key => $value) { if (is_bool($value)) { $value = $value ? 1 : 0; } $query->bindValue(is_numeric($key) ? $key + 1 : $key, $value); } $query->execute(); $result = $query->fetchAll(\PDO::FETCH_ASSOC); return $result ? $result : array(); } catch (\PDOException $e) { throw new \Ip\Exception\Db($e->getMessage(), $e->getCode(), $e); } } public function selectAll($table, $columns, $where = array(), $sqlEnd = '') { if (is_array($columns)) { $columns = '`' . implode('`,`', $columns) . '`'; } $sql = 'SELECT ' . $columns . ' FROM ' . ipTable($table); $params = array(); $sql .= " WHERE " . $this->buildConditions($where, $params) . " "; if ($sqlEnd) { $sql .= $sqlEnd; } return $this->fetchAll($sql, $params); } public function selectRow($table, $columns, $where, $sqlEnd = '') { $result = $this->selectAll($table, $columns, $where, $sqlEnd . ' LIMIT 1'); return $result ? $result[0] : null; } public function selectValue($table, $column, $where, $sqlEnd = '') { $result = $this->selectAll($table, $column, $where, $sqlEnd . ' LIMIT 1'); return $result ? array_shift($result[0]) : null; } public function selectColumn($table, $column, $where, $sqlEnd = '') { $sql = 'SELECT ' . $column . ' FROM ' . ipTable($table); $params = array(); $sql .= ' WHERE '; if ($where) { foreach ($where as $column => $value) { if ($value === null) { $sql .= "`{$column}` IS NULL AND "; } else { $sql .= "`{$column}` = ? AND "; if (is_bool($value)) { $value = $value ? 1 : 0; } $params[] = $value; } } $sql = substr($sql, 0, -4); } else { $sql .= ' 1 '; } if ($sqlEnd) { $sql .= $sqlEnd; } try { $query = $this->getConnection()->prepare($sql); foreach ($params as $key => $value) { if (is_bool($value)) { $value = $value ? 1 : 0; } $query->bindValue($key + 1, $value); } $query->execute(); return $query->fetchAll(\PDO::FETCH_COLUMN); } catch (\PDOException $e) { throw new \Ip\Exception\Db($e->getMessage(), $e->getCode(), $e); } } public function execute($sql, $params = array()) { try { $query = $this->getConnection()->prepare($sql); foreach ($params as $key => $value) { if (is_bool($value)) { $value = $value ? 1 : 0; } $query->bindValue(is_numeric($key) ? $key + 1 : $key, $value); } $query->execute(); return $query->rowCount(); } catch (\PDOException $e) { throw new \Ip\Exception\Db($e->getMessage(), $e->getCode(), $e); } } public function fetchColumn($sql, $params = array()) { try { $query = $this->getConnection()->prepare($sql); foreach ($params as $key => $value) { if (is_bool($value)) { $value = $value ? 1 : 0; } $query->bindValue(is_numeric($key) ? $key + 1 : $key, $value); } $query->execute(); return $query->fetchAll(\PDO::FETCH_COLUMN); } catch (\PDOException $e) { throw new \Ip\Exception\Db($e->getMessage(), $e->getCode(), $e); } } public function insert($table, $row, $ignore = false) { $params = array(); $values = ''; $_ignore = $ignore ? ($this->isSqlite()?"OR IGNORE":"IGNORE") : ""; $sql = "INSERT {$_ignore} INTO " . ipTable($table) . " ("; foreach ($row as $column => $value) { $sql .= "`{$column}`, "; if (is_bool($value)) { $value = $value ? 1 : 0; } $params[] = $value; $values.='?, '; } $sql = substr($sql, 0, -2); $values = substr($values, 0, -2); $sql .= ") VALUES (${values})"; if (empty($params)) { $sql = "INSERT {$_ignore} INTO " . ipTable($table) . " () VALUES()"; } if ($this->execute($sql, $params)) { $lastInsertId = $this->getConnection()->lastInsertId(); if ($lastInsertId === '0') { return true; } return $lastInsertId; } else { return false; } } public function delete($table, $condition) { $sql = "DELETE FROM " . ipTable($table, false) . " WHERE "; $params = array(); $sql .= $this->buildConditions($condition, $params); return $this->execute($sql, $params); } public function update($table, $update, $condition) { if (empty($update)) { return false; } $sql = 'UPDATE ' . ipTable($table) . ' SET '; $params = array(); foreach ($update as $column => $value) { $sql .= "`{$column}` = ? , "; if (is_bool($value)) { $value = $value ? 1 : 0; } $params[] = $value; } $sql = substr($sql, 0, -2); $sql .= " WHERE "; $sql .= $this->buildConditions($condition, $params); return $this->execute($sql, $params); } public function upsert($table, $keys, $values) { if ($this->insert($table, array_merge($keys, $values), true) == false) { $this->update($table, $values, $keys); } } public function tablePrefix() { return $this->tablePrefix; } public function isConnected() { return $this->pdoConnection ? true : false; } public function getDriverName() { return $this->pdoConnection->getAttribute(\PDO::ATTR_DRIVER_NAME); } public function isSQLite() { return $this->getDriverName() == 'sqlite'; } public function isMySQL() { return $this->getDriverName() == 'mysql'; } public function sqlMinAge($fieldName, $minAge, $unit='HOUR') { if (!in_array($unit, array('MINUTE', 'HOUR'))) { throw \Ip\Exception("Only 'MINUTE' or 'HOUR' are available as unit options."); } if (ipDb()->isMySQL()) { $sql = "`".$fieldName."` < NOW() - INTERVAL " . ((int)$minAge) . " ".$unit; } else { $divider = 1; switch($unit) { case 'HOUR': $divider = 60*60; break; case 'MINUTE': $divider = 60; break; } $sql = "((STRFTIME('%s', 'now', 'localtime') - STRFTIME('%s', `".$fieldName. "`)/".$divider.")>". ((int)$minAge). ") "; } return $sql; } public function sqlMaxAge($fieldName, $maxAge, $unit='HOUR') { if (!in_array($unit, array('MINUTE', 'HOUR'))) { throw \Ip\Exception("Only 'MINUTE' or 'HOUR' are available as unit options."); } if (ipDb()->isMySQL()) { $sql = "`".$fieldName."` > NOW() - INTERVAL " . ((int)$maxAge) . " ".$unit; } else { switch($unit) { case 'HOUR': $divider = 60*60; break; case 'MINUTE': $divider = 60; break; } $sql = "((STRFTIME('%s', 'now', 'localtime') - STRFTIME('%s', `".$fieldName. "`)/".$divider.")>". ((int)$maxAge). ") "; } return $sql; } protected function buildConditions($conditions = array(), &$params = array()) { if (empty($conditions)) { return '1'; } $sql = ''; if (is_array($conditions)) { foreach ($conditions as $column => $value) { $realCol = $column; $pair = $this->containsOperator($column); if ($pair) { $realCol = $pair[0]; } if ($value === null) { $isNull = 'IS NULL AND'; if ($pair && preg_match("/(<>|!=)/", $pair[1])) { $isNull = 'IS NOT NULL AND'; } $sql .= "`{$realCol}` {$isNull} "; } else { if ($pair) { $sql .= "`{$realCol}` {$pair[1]} ? AND "; } else { $sql .= "`{$realCol}` = ? AND "; } if (is_bool($value)) { $value = $value ? 1 : 0; } $params[] = $value; } } $sql = substr($sql, 0, -4); } else { $sql .= " `id` = ? "; $params[] = $conditions; } return $sql; } protected function containsOperator($value) { $idents = preg_split("/(<=>|>=|<=|<>|>|<|!=|=|LIKE)/", $value, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY); if (count($idents) <= 1) { return false; } else { return array_map('trim', $idents); } } } ?>