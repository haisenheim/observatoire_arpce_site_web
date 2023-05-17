<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

class ExtendedController extends Controller
{
    //
	protected function authExtensions(){
		return array('jpg','png','jpeg','gif','GIF','PNG','JPG','JPEG','pdf','PDF','Pdf');
	}

	protected function entityImgCreate($file,$entity,$name_without_extension){

		$ext = $file->getClientOriginalExtension();
		$arr_ext = $this->authExtensions();

		if (!file_exists(public_path('img') . '/'.$entity)) {
			mkdir(public_path('img') . '/'.$entity);
		}
		if(in_array($ext,$arr_ext)) {
			$name_with_extension = $name_without_extension . '.' . $ext;
			if (file_exists(public_path('img') . '/' . $entity . '/' . $name_with_extension)) {
				unlink(public_path('img') . '/' . $entity . '/' . $name_with_extension);
			}
			$imageUri = $entity.'/'.$name_with_extension;
			$file->move(public_path('img/' . $entity), $name_with_extension);
			return $imageUri;
		}

		return null;
	}

    protected function entityPhotoCreate($file,$entity,$name_without_extension){

		$ext = $file->getClientOriginalExtension();
		$arr_ext = $this->authExtensions();

		if (!file_exists(public_path('img') . '/'.$entity)) {
			mkdir(public_path('img') . '/'.$entity);
		}
		if(in_array($ext,$arr_ext)) {
			$name_with_extension = $name_without_extension . '.' . $ext;
			if (file_exists(public_path('img') . '/' . $entity . '/' . $name_with_extension)) {
				unlink(public_path('img') . '/' . $entity . '/' . $name_with_extension);
			}
			$imageUri = $name_with_extension;
			$file->move(public_path('img/' . $entity), $name_with_extension);
			return $imageUri;
		}

		return null;
	}

	protected function entityDocumentCreate($file,$entity,$name_without_extension){

		$ext = $file->getClientOriginalExtension();
		$arr_ext = $this->authExtensions();

		if (!file_exists(public_path('documents'))) {
			mkdir(public_path('documents'));
		}

		if (!file_exists(public_path('documents') . '/'.$entity)) {
			mkdir(public_path('documents') . '/'.$entity);
		}
		if(in_array($ext,$arr_ext)) {
			$name_with_extension = $name_without_extension . '.' . $ext;

			if (file_exists(public_path('documents') . '/' . $entity . '/' . $name_with_extension)) {
				unlink(public_path('documents') . '/' . $entity . '/' . $name_with_extension);
			}
			$imageUri = $entity.'/'.$name_with_extension;
			$file->move(public_path('documents/' . $entity), $name_with_extension);
			return $imageUri;
		}else{
			//dd('ok');
			request()->session()->flash('danger',' Impossible d\'enregistrer le fichier !!!');
		}


		return null;
	}
}
