<?php
class Tree {
	static function get(&$arrData, $pid = 0) {
		if ($pid == 0) {
			usort ( $arrData, 'psort' );
		}
		$result = array ();
		foreach ( $arrData as $key => $row ) {
			$result [$row ['id']] ['self'] = $row;
			$result [$row ['id']] ['child'] = array ();
			$yes = false;
			if ($pid == $row ['pid']) {
				$yes = true;
				unset ( $arrData [$key] );
				foreach ( $arrData as $row2 ) {
					if ($row2 ['pid'] == $row ['id']) {
						$sz = self::get ( $arrData, $row2 ['id'] );
						$result [$row ['id']] ['child'] = array_merge ( $result [$row ['id']] ['child'], array (array ('self' => $row2, 'child' => $sz ) ) );
					}
				}
			}
			if (! $yes) {
				unset ( $result [$row ['id']] );
			}
		}
		return $result;
	}
	function tagGet($arrData, $depth = 0) {
		$result = array ();
		if ($depth == 0) {
			$arrData = self::get ( $arrData );
		}
		foreach ( $arrData as $row ) {
			$row ['self'] ['tag'] = '<font color=red>' . str_repeat ( '|--', $depth ) . '</font>';
			$result [] = $row ['self'];
			$pdepth = $depth + 1;
			$result = array_merge ( $result, self::tagGet ( $row ['child'], $pdepth ) );
		}
		return $result;
	}

}
function psort($a, $b) {
	return $a ['pid'] > $b ['pid'] ? 1 : - 1;
}