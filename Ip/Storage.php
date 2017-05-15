<?php namespace Ip; class Storage { public function get($pluginName, $key, $defaultValue = null) { $sql = '
            SELECT
                value
            FROM
                ' . ipTable('storage') . '
            WHERE
                `plugin` = :plugin AND
                `key` = :key
        '; $params = array( ':plugin' => $pluginName, ':key' => $key ); $row = ipDb()->fetchRow($sql, $params); if (!$row) { if ($defaultValue instanceof \Closure) { return $defaultValue(); } else { return $defaultValue; } } return json_decode($row['value'], true); } public function set($pluginName, $key, $value) { $keys = array( 'plugin' => $pluginName, 'key' => $key ); $values = array( 'value' => json_encode($value) ); ipDb()->upsert('storage', $keys, $values); } public function getAll($plugin) { $sql = '
            SELECT
                `key`, `value`
            FROM
                ' . ipTable('storage') . '
            WHERE
                `plugin` = :plugin
            '; $params = array( ':plugin' => $plugin ); $records = ipDb()->fetchAll($sql, $params); $values = array(); foreach ($records as $record) { $values[] = array( 'key' => $record['key'], 'value' => json_decode($record['value'], true) ); } return $values; } public function remove($pluginName, $key) { $sql = '
            DELETE FROM
                ' . ipTable('storage') . '
            WHERE
                `plugin` = :plugin
                AND
                `key` = :key
        '; $params = array( ':plugin' => $pluginName, ':key' => $key ); ipDb()->execute($sql, $params); } public function removeAll($pluginName) { $sql = '
            DELETE FROM
                ' . ipTable('storage') . '
            WHERE
                `plugin` = :plugin
        '; $params = array( ':plugin' => $pluginName ); ipDb()->execute($sql, $params); } } ?>