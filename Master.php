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
     * Insert data in the JSON
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
     * Insert level into another level the JSON
     */
    function insert_child_data($id, $title, $bizagi_folder, $clickeable = false )
    {

        $data = file_get_contents($this->data_file);
        $json_arr = json_decode($data, true);

        $new_data[] =  [
            "id" => $id,
            "text" => $title,
            "bizagi_folder" => $bizagi_folder,
            "clickeable" => $clickeable,
            "items" => []
        ];
        

        foreach ($json_arr as $key => $value) {
            if ($value['id'] == $id) {
                $json_arr[$key]['items'] = array_values($new_data) ;
                //break;
            }
        }

        file_put_contents($this->data_file, json_encode($json_arr, JSON_PRETTY_PRINT));
    }

    /**
     * Update JSON record
     */
    function update_json_data($id, $title)
    {
        $data = file_get_contents($this->data_file);
        $json_arr = json_decode($data, true);

        foreach ($json_arr as $key => $value) {
            if ($value['id'] == $id) {
                $json_arr[$key]['text'] = $title;
            }
        }

        file_put_contents($this->data_file, json_encode($json_arr, JSON_PRETTY_PRINT));
    }

    /**
     * Destroy record from JSON
     */
    function delete_data($id = '')
    {
        if (empty($id)) {
            $resp['status'] = 'failed';
            $resp['error'] = 'El ID dado está vacío.';
        } else {
            $data = $this->get_all_data();
            if (isset($data[$id])) {
                unset($data[$id]);
                $json = json_encode(array_values($data), JSON_PRETTY_PRINT);
                $update = file_put_contents($this->data_file, $json);
                if ($update) {
                    $resp['status'] = 'success';
                } else {
                    $resp['failed'] = 'failed';
                }
            } else {
                $resp['status'] = 'failed';
                $resp['error'] = 'El ID dado no existe.';
            }
        }
        return $resp;
    }
}
