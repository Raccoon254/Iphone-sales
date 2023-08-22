<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Termwind\Components\Dd;

class WiseController extends Controller
{
    protected string $baseUrl = 'https://api.sandbox.transferwise.tech/';
    public function getUserInfo()
    {
        $token = ENV('WISE_TOKEN');
        $baseUrl = 'https://api.sandbox.transferwise.tech/v1/me';

        $client = new Client([
            'base_uri' => $baseUrl,
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json',
            ],
        ]);

        try {
            $response = $client->get('');
            // Now you can use $userInfo to access user's details
            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            return "Error: " . $e->getMessage();
        } catch (GuzzleException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    //GET the balance of the user

    public function getBalance($profileId, $balanceId)
    {
        $token = env('WISE_TOKEN');
        $url = $this->baseUrl . "v4/profiles/{$profileId}/balances/{$balanceId}";

        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
            ],
        ]);

        try {
            $response = $client->get($url);
            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            return "Error: " . $e->getMessage();
        } catch (GuzzleException $e) {
            return "Error: " . $e->getMessage();
        }
    }


    public function getAllBalances()
    {
        $profileId = $this->getUserInfo()['id'];
        $token = env('WISE_TOKEN');
        $url = $this->baseUrl . "v4/profiles/{$profileId}/balances?types=STANDARD"; // Change 'STANDARD' to 'SAVINGS' if needed

        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
            ],
        ]);

        try {
            $response = $client->get($url);
            $balances = json_decode($response->getBody(), true);

            return $balances;
        } catch (\Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }


}
