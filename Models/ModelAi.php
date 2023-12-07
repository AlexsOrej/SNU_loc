<?php
class ModelAi
{



    public function AI($pregunta)
    {
        // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Verificar si se recibió la pregunta del chat
        // if (isset($_POST['mensaje'])) {
        // Obtener la pregunta del chat
        // $pregunta = $_POST['mensaje'];

        $api_key = "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";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/chat/completions');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $api_key,
        ]);

        $data = [
            //'model' => 'gpt-4',
            'model' => 'gpt-3.5-turbo-16k-0613',
            //'model' => 'gpt-3.5-turbo',
            'messages' => [],
        ];

        $data['messages'][] = ['role' => 'system', 'content' => 'Actua como un gerente o manager experto de una gran multinacional y da informacion maximo con 250 caracteres, recomendaciones de valor sobre omite las explicaciones,saludos hazlo en forma de lista dando un salto de linea por cada item y dame solo 2, responde en tono Amigable,entuciasta, alentador, creativo, preciso,Informativo,'];
        $data['messages'][] = ['role' => 'user', 'content' => $pregunta];

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));


        $response = curl_exec($ch);
        $respuesta = '';
        $decoded_response = json_decode($response, true);

        if (isset($decoded_response['choices'][0]['message']['content'])) {
            $respuesta = $decoded_response['choices'][0]['message']['content'];
        }

        curl_close($ch);
        //print_r($decoded_response);
        return $respuesta;

        // }
    }
}
