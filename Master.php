<?php

class Master
{
    public $data_file = "data.json";

    /**
     * Get all data from JSON
     */
    function get_all_data()
    {
        $json = (array) json_decode(file_get_contents($this->data_file));
        $data = [];
        foreach ($json as $row) {
            $data[$row->id] = $row;
        }
        return $data;
    }

    /**
     * Get specific data from JSON
     */
    function get_data($id = '')
    {
        if (!empty($id)) {
            $data = $this->get_all_data();
            if (isset($data[$id])) {
                return $data[$id];
            }
        }
        return (object) [];
    }

    /**
     * Insert data in the JSON (LEVEL 1)
     */
    function insert_to_json($title, $bizagi_folder, $clickeable = false )
    {
        $data = $this->get_all_data();
        $id = array_key_last($data) + 1;
        $data[$id] = (object) [
            "id" => $id,
            "text" => $title,
            "bizagi_folder" => $bizagi_folder,
            "clickeable" => $clickeable,
            "items" => []
        ];
        $json = json_encode(array_values($data), JSON_PRETTY_PRINT);
        $insert = file_put_contents($this->data_file, $json);
        if ($insert) {
            $resp['status'] = 'success';
        } else {
            $resp['failed'] = 'failed';
        }
        return $resp;
    }

    
    /**
     * Update JSON record
     */
    function update_json_data($id, $title)
    {
        $data = file_get_contents($this->data_file);
        $json_arr = json_decode($data, true);
        $ids = explode("_", $id);

        switch (count($ids)){
            case 1:
                foreach($json_arr as $key => $value){
                    if( $value['id'] == $id ){
                        $json_arr[$key]['text'] = $title;

                        $json = json_encode($json_arr, JSON_PRETTY_PRINT);
                        file_put_contents($this->data_file, $json);
                    }
                }
                break;

            case 2:
                foreach($json_arr as $key => $value){
                    if( $value['id'] == $ids[0] ){
                        foreach($value['items'] as $k => $items){
                            if ($items['id'] == $id){
                                $json_arr[$key]['items'][$k]['text'] = $title;

                                $json = json_encode($json_arr, JSON_PRETTY_PRINT);
                                file_put_contents($this->data_file, $json);
                            }
                        }
                    }
                }
                break;

            case 3:
                foreach($json_arr as $key => $value){
                    if( $value['id'] == $ids[0] ){
                        foreach($value['items'] as $k => $items){
                            if ($items['id'] == $ids[0]."_".$ids[1]){
                                foreach($items['items'] as $k3 => $item3){
                                    if ($item3['id'] == $id){
                                        $json_arr[$key]['items'][$k]['items'][$k3]['text'] = $title;

                                        $json = json_encode(array_values($json_arr), JSON_PRETTY_PRINT);
                                        file_put_contents($this->data_file, $json);
                                    }
                                }
                            }
                        }
                    }
                }
                break;
        }
    }

    /**
     * Destroy record from JSON
     */
    function delete_data($id = '')
    {
        $data = file_get_contents($this->data_file);
        $json_arr = json_decode($data, true);
        $ids = explode("_", $id);

        switch (count($ids)){
            case 1:
                foreach($json_arr as $key => $value){
                    if( $value['id'] == $id ){
                        unset($json_arr[$key]);
                        $json = json_encode(array_values($json_arr), JSON_PRETTY_PRINT);
                        file_put_contents($this->data_file, $json);
                    }
                }
                break;
            case 2:
                foreach($json_arr as $key => $value){
                    if( $value['id'] == $ids[0] ){
                        foreach($value['items'] as $k => $items){
                            if ($items['id'] == $id){
                                unset( $json_arr[$key]['items'][$k] );
                                $json = json_encode(array_values($json_arr), JSON_PRETTY_PRINT);
                                file_put_contents($this->data_file, $json);
                            }
                        }
                    }
                }
                break;
            case 3:
                foreach($json_arr as $key => $value){
                    if( $value['id'] == $ids[0] ){
                        foreach($value['items'] as $k => $items){
                            if ($items['id'] == $ids[0]."_".$ids[1]){
                                foreach($items['items'] as $k3 => $item3){
                                    if ($item3['id'] == $id){
                                        unset( $json_arr[$key]['items'][$k]['items'][$k3] );
                                        $json = json_encode(array_values($json_arr), JSON_PRETTY_PRINT);
                                        file_put_contents($this->data_file, $json);
                                    }
                                }
                            }
                        }
                    }
                }
                break;
        }

    }

    /**
     * Insert level into another level the JSON (LEVEL 2-3)
     */
    function insert_child($id, $title, $bizagi_folder, $clickeable = false )
    {

        $data = file_get_contents($this->data_file);
        $json_arr = json_decode($data, true);
        $ids = explode("_", $id);

        switch (count($ids)){
            
            case 1:                
                foreach($json_arr as $key => $value){
                    if( $value['id'] == $ids[0] ){
                        // Set new id
                        if ( count($value['items']) > 0 ){
                            $last_id = explode('_', end( $value['items'] )['id']);
                            $child_id = $id."_".(end($last_id) + 1);
                        }else{
                            $child_id = $id."_1";
                        }                               
                        $new_data =  [
                            "id" => $child_id,
                            "text" => $title,
                            "bizagi_folder" => $bizagi_folder,
                            "clickeable" => $clickeable,
                            "items" => []
                        ];
                        array_push($json_arr[$key]['items'], $new_data);                                                            
                        $json = json_encode(array_values($json_arr), JSON_PRETTY_PRINT);
                        file_put_contents($this->data_file, $json);                        
                    }
                }
                break;
            case 2:                
                foreach($json_arr as $key => $value){
                    if( $value['id'] == $ids[0] ){
                        foreach($value['items'] as $k => $value2){
                            if ($value2['id'] == $id){
                                // Set new id
                                if ( count($value2['items']) > 0 ){
                                    $last_id = explode('_', end( $value2['items'] )['id']);
                                    $child_id = $id."_".(end($last_id) + 1);
                                }else{
                                    $child_id = $id."_1";
                                }                               
                                $new_data =  [
                                    "id" => $child_id,
                                    "text" => $title,
                                    "bizagi_folder" => $bizagi_folder,
                                    "clickeable" => $clickeable,
                                    "items" => []
                                ];
                                array_push($json_arr[$key]['items'][$k]['items'], $new_data);                                                            
                                $json = json_encode(array_values($json_arr), JSON_PRETTY_PRINT);
                                file_put_contents($this->data_file, $json);
                        }
                    }
                }
            }
            break;
            
        }


    }


}
