<?php

namespace App\Libs;

use Log;

class GoogleDrive
{
    /**
     * Googleドライブへの認証を行う
     * @return Google_Service_Drive
     */
    public function getDriveClient(): \Google_Service_Drive
    {
        $client = new \Google_Client();

        // サービスアカウント作成時にダウンロードしたJSONファイルの名前を「client_secret」変更し、configフォルダ内に設置
        $client->setAuthConfig(config_path('client_secret.json'));
        $client->setScopes(['https://www.googleapis.com/auth/drive']);

        return new \Google_Service_Drive($client);
    }

    /**
     * Googleドライブへの認証を行う
     * @return Google_Service_Drive
     */
    public function getSheetClient(): \Google_Service_Drive
    {
        $client = new \Google_Client();

        // サービスアカウント作成時にダウンロードしたJSONファイルの名前を「client_secret」変更し、configフォルダ内に設置
        $client->setAuthConfig(config_path('client_secret.json'));
        $client->setScopes([
            \Google_Service_Sheets::SPREADSHEETS, // スプレッドシート
            \Google_Service_Sheets::DRIVE, // ドライブ
        ]);

        return new \Google_Service_Drive($client);
    }

    /**
     * スプレッドシートを取得する
     *
     */
    public function getSpreadSheet($id)
    {
        $client = new \Google_Client();

        // サービスアカウント作成時にダウンロードしたJSONファイルの名前を「client_secret」変更し、configフォルダ内に設置
        $client->setAuthConfig(config_path('client_secret.json'));
        $client->setScopes([
            \Google_Service_Sheets::SPREADSHEETS, // スプレッドシート
            \Google_Service_Sheets::DRIVE, // ドライブ
        ]);
        $spreadsheet_service = new \Google_Service_Sheets($client);
        
        $range = 'event_sheet!A5:N'; // 取得する範囲
        $response = $spreadsheet_service->spreadsheets_values->get($id, $range);
        $values = $response->getValues();

        return $values;
    }

    
    /**
     * ファイルをアップロードする
     *
     * @return GoogleDrive
     */
    public function fileUpload()
    {
        $driveClient = $this->getDriveClient();

        $fileMetadata = new \Google_Service_Drive_DriveFile([
            'name' => 'sample.jpg', // Googleドライブへアップロードされた際のファイル名（今回は「sample.jpg」とする）
            'parents' => ['106Xuf6Q3lKcbfyloy8YOtxj6hzNdRyxR'], // 保存先のフォルダID（配列で渡さなければならないので注意）
        ]);

        $driveClient->files->create($fileMetadata, [
            'data' => file_get_contents(storage_path('app/public/img/sample.jpg')), // アップロード対象となるファイルのパス（今回はstorage/app/public配下の「sample.jpg」を指定）
            'mimeType' => ' image/jpeg',
            'uploadType' => 'media',
            'fields' => 'id',
        ]);
    }
}