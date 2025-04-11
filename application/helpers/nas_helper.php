<?php

if (! function_exists('upload_nas')){
    function upload_nas($source = null) {
        $result = array();
        if($source){
            $CI = & get_instance();
            
            $source_file = ((get_option('env') == 'production')?".":rtrim(FCPATH, '/')).$source;
            $destination = ((get_option('env') == 'production')?"/var/www/nas":'\\\\'.get_option('url_nas').'\\AnandaFile\\Development').str_replace('\\','/',$source);;
            $start=time();
            $success = false;
            do{
                try{
                    if (!file_exists(dirname($destination))) {
                        mkdir(dirname($destination), 0777, true);
                    }
                    if(file_exists($destination)){
                        if (!unlink($destination)) {
                            $result['catatan'] = 'Gagal Menghapus File pada NAS path :'.$destination;
                            $result['status'] = $success = false;
                            return (object) $result;
                        }
                    }
                    if(!copy( $source_file, $destination)){
                        $result['catatan'] ='Gagal Meynyalin File ke NAS source:'.$source_file.' destination :'.$destination;
                        $result['status'] = $success = false;
                        return (object) $result;
                    }
                    if (!unlink($source_file)) {
                        $result['catatan'] ='Gagal Menghapus File pada server path :'.$file_path;
                        $result['status'] = $success = false;
                        return (object) $result;
                    }
                    $result['status'] = $success = true;
                    return (object) $result;
                }catch(\Exception $e){
                    $result['catatan'] = 'Error server. error :'.$e;
                    $result['status'] = $success = false;
                    return (object) $result;
                }
            }while((!$success && time()-$start <= 3000));
        }else{
            $result['catatan'] = 'Error server. source :'.$source;
            $result['status'] = false;
            return (object) $result;
        }
    }
}

if (! function_exists('download_nas')){
    function download_nas($source = null, $replace_special_char = false, $new_special_char = '-') {
        $result = array();
        if($source){
            $CI = & get_instance();
            
            $source_file = ((get_option('env') == 'production')?"/var/www/nas":'\\\\'.get_option('url_nas').'\\AnandaFile\\Development').str_replace('\\','/',$source);;
            $destination = ((get_option('env') == 'production')?".":rtrim(FCPATH, '/')).((@$replace_special_char)?str_replace([':', '\\', '*','#',' ',','], (@$new_special_char?:'-'), $source):$source);
            $start=time();
            $success = false;
            do{
                try{
                    if (!file_exists(dirname($destination))) {
                        mkdir(dirname($destination), 0777, true);
                    }
                    if(file_exists($destination)){
                        if (!unlink($destination)) {
                            $result['catatan'] = 'Gagal Menghapus File pada Server path :'.$destination;
                            $result['status'] = $success = false;
                            return (object) $result;
                        }
                    }
                    if(!copy( $source_file, $destination)){
                        $result['catatan'] ='Gagal Meynyalin File ke Server source:'.$source_file.' destination :'.$destination;
                        $result['status'] = $success = false;
                        return (object) $result;
                    }
                    // if (!unlink($source_file)) {
                    //     $result['catatan'] ='Gagal Menghapus File pada server path :'.$file_path;
                    //     $result['status'] = $success = false;
                    //     return (object) $result;
                    // }
                    $result['status'] = $success = true;
                    return (object) $result;
                }catch(\Exception $e){
                    $result['catatan'] = 'Error server. error :'.$e;
                    $result['status'] = $success = false;
                    return (object) $result;
                }
            }while((!$success && time()-$start <= 3000));
        }else{
            $result['catatan'] = 'Error server. source :'.$source;
            $result['status'] = false;
            return (object) $result;
        }
    }
}

if (! function_exists('delete_nas')){
    function delete_nas($source = null) {
        $result = array();
        if($source){
            $CI = & get_instance();
            
            $source_file = ((get_option('env') == 'production')?"/var/www/nas":'\\\\'.get_option('url_nas').'\\AnandaFile\\Development').str_replace('\\','/',$source);;
            // $destination = ((get_option('env') == 'production')?".":rtrim(FCPATH, '/')).$source;
            $start=time();
            $success = false;
            do{
                try{
                    // if (!file_exists(dirname($destination))) {
                    //     mkdir(dirname($destination), 0777, true);
                    // }
                    if(file_exists($source_file)){
                        if (!unlink($source_file)) {
                            $result['catatan'] = 'Gagal Menghapus File pada Server path :'.$source_file;
                            $result['status'] = $success = false;
                            return (object) $result;
                        }
                    }
                    // if(!copy( $source_file, $destination)){
                    //     $result['catatan'] ='Gagal Meynyalin File ke Server source:'.$source_file.' destination :'.$destination;
                    //     $result['status'] = $success = false;
                    //     return (object) $result;
                    // }
                    // if (!unlink($source_file)) {
                    //     $result['catatan'] ='Gagal Menghapus File pada server path :'.$file_path;
                    //     $result['status'] = $success = false;
                    //     return (object) $result;
                    // }
                    $result['status'] = $success = true;
                    return (object) $result;
                }catch(\Exception $e){
                    $result['catatan'] = 'Error server. error :'.$e;
                    $result['status'] = $success = false;
                    return (object) $result;
                }
            }while((!$success && time()-$start <= 3000));
        }else{
            $result['catatan'] = 'Error server. source :'.$source;
            $result['status'] = false;
            return (object) $result;
        }
    }
}

if (! function_exists('view_nas')){
    function view_nas($source = null) {
        if($source){
            $CI = & get_instance();
            
            $source_file = ((get_option('env') == 'production')?".":rtrim(FCPATH, '/')).$source;
            $destination = ((get_option('env') == 'production')?"/var/www/nas":'\\\\'.get_option('url_nas').'\\AnandaFile\\Development').str_replace('\\','/',$source);;
            $start=time();
            $success = false;
            do{
                try{
                    if (!file_exists(dirname($destination))) {
                        mkdir(dirname($destination), 0777, true);
                    }
                    if(file_exists($destination)){
                        return $destination;
                        // if (!unlink($destination)) {
                        //     $result[] = ['catatan'=>'Gagal Menghapus File pada NAS path :'.$destination];
                        //     return $success = false;
                        // }
                    }
                    // $copy = copy( $source_file, $destination);
                    // unlink($source_file);// harusnya di aktifkan supaya tidak nyampah pada server
                    // return $success = true;
                    return false;
                }catch(\Exception $e){
                    // return $success = false;
                    return false;
                }
            }while((!$success && time()-$start <= 3000));
        }else{
            return false;
        }
    }
}

if (! function_exists('get_nas')){
    function get_nas() {
        return (get_option('url_nas')?((get_option('env') == 'production')?"/var/www/nas":'\\\\'.get_option('url_nas').'\\AnandaFile\\Development'):null);
    }
}