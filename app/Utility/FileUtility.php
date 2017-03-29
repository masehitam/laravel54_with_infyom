<?php
namespace App\Utility;

/**
 *  It is used to process data with file
 */

use Illuminate\Support\Facades\Input;

class FileUtility {



	/**
	 * @param $filename
	 *
	 * @return void
	 */
	public static function delete($filename) {
		if (file_exists($filename)) {
			unlink($filename);
		}
	}

	/**
	 * @param $fileImage
	 * @param $basePath
	 * @return string
	 */
	public static function saveUploadImage($fileImage, $basePath) {
		$imagePath = '';
		if (Input::hasFile($fileImage) && Input::file($fileImage) !== NULL) {
			$imagePath = $basePath;
			$image = Input::file($fileImage);

			/* Remove space from image filename */
			$filename = str_replace(' ', '', $image->getClientOriginalName());
			$image->move($imagePath, $filename);
			$imagePath = $imagePath . '/' . $filename;
		}
		return $imagePath;
	}

	/**
	 * @param $data
	 * @param $objectImagePath
	 * @param $fieldImage
	 * @param $basePath
	 * @param $storeDelete
	 * @return null|string
	 */
	public static function saveEditUploadImage($data, $objectImagePath, $fieldImage, $basePath, $storeDelete) {
		$imagePath = $objectImagePath;
		if (isset($data[$storeDelete]) && (int)$data[$storeDelete] == 1) {
			$imagePath = NULL;
		}
		if (Input::hasFile($fieldImage) && Input::file($fieldImage) !== NULL) {
			$imagePath = $basePath;
			$image = Input::file($fieldImage);

			/* Remove space from image filename */
			$filename = str_replace(' ', '', $image->getClientOriginalName());
			$image->move($imagePath, $filename);
			$imagePath = $imagePath . '/' . $filename;
			FileUtility::delete($objectImagePath);
		}
		return $imagePath;
	}
}
