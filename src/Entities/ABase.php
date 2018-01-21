<?php

/**
 * Created by PhpStorm.
 * User: PaarBreakdowns
 * Date: 20.04.2017
 * Time: 19:28
 */
abstract class ABase {
	/**
	 * @param array $data
	 * @return Adresse
	 */
	public function setData( array $data ): ABase {
		if (!empty($data)) {
			foreach ($data AS $key => $val) {
				$methodName = 'set' . ucfirst($key);
				if(method_exists($this, $methodName)) {
					$this->$methodName($val);
				}
			}
		}
		return $this;
	}
}