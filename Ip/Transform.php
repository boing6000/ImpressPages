<?php namespace Ip; abstract class Transform { public abstract function transform($sourceFile, $destinationFile); public function getNewExtension($sourceFile, $ext) { return $ext; } public function getParamStr() { return serialize(get_object_vars($this)); } final public function getFingerprint() { return md5(__CLASS__ . ':' . $this->getParamStr()); } } ?>