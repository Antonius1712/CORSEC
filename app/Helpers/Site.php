<?php
namespace App\Helpers;

use App\Model\History;

// ! TO USE THIS CLASS AS facades -> \Site::methhod(), YOU NEED TO CONFIG:
// ! 1. ADD /facades/site.php
// ! 2. ADD /config/app.php
// ! 3. ADD /Providers/AppSerciveProviders.php

class Site {
    public function save_history($data, $user, $action){
      // dd($data, $user, $action);
      try {
        $description = $data->document_name . ' ' . $data->document_filename . ' ' . $data->status . ' ' . $data->master_document->document_type;
        $history = new History;
        $history->document_id = $data->id;
        $history->nik = $user;
        $history->action = $action;
        $history->description = $description;
        $history->save();
        
        return 'Sukses';
      } catch (\Exception $e) {
        return $e->getMessage();
      }
    }
}