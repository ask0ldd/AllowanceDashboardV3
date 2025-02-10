<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Models\TokenContract;
use App\Models\Address;
use App\Services\TokenService;
use App\Http\Resources\TokenContractResource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;

class TokenServiceTest extends TestCase
{
    use RefreshDatabase;

    private TokenService $tokenService;

    private $defaultTokens = [
        ['name' => 'CrystalDrive', 'symbol' => 'CRD', 'token_address' => '0xf33c13a871b8132827D0370359024726d137D98F', 'decimals' => 18],
        ['name' => 'CyberSpark', 'symbol' => 'CSP', 'token_address' => '0xdc52fd9c0F960059932E1bcD521B3C588134f62E', 'decimals' => 18],
        ['name' => 'EchoChain', 'symbol' => 'ECH', 'token_address' => '0x1Bdd01191B1c4134D2071B39ea846b9E1Ac2De2e', 'decimals' => 18],
        ['name' => 'NeoNova', 'symbol' => 'NOV', 'token_address' => '0xB55506abfF9212E3447Ca7942A8c75b77FAd61A7', 'decimals' => 18],
        ['name' => 'NimbusNet', 'symbol' => 'NMB', 'token_address' => '0x78490E03B50bec0922397DE03966CcbA133dD84D', 'decimals' => 18],
        ['name' => 'PrimeFlow', 'symbol' => 'PRM', 'token_address' => '0x4E484a9329006770f3b0090F31e96FbD054b9e10', 'decimals' => 18],
        ['name' => 'Quantum', 'symbol' => 'QTM', 'token_address' => '0xE659d196348ff53Db02a0989Fe513c60ba6B09D1', 'decimals' => 18],
        ['name' => 'StellarPulse', 'symbol' => 'STP', 'token_address' => '0x48BD931FF170CCF38190D2A617C133Ab28fc1ef5', 'decimals' => 18],
        ['name' => 'VertexCoin', 'symbol' => 'VTX', 'token_address' => '0xEa2616479716cc345a7797C71639A306451A9AC5', 'decimals' => 18],
        ['name' => 'ZenithToken', 'symbol' => 'ZNT', 'token_address' => '0xA9DE06F5692AFFe05A5661708cF59F14c2BA19c4', 'decimals' => 18],
        ['name' => 'SolarFlare', 'symbol' => 'SFL', 'token_address' => '0x9429708fD69C596037bAF376C2b2e0cd105Cd34a', 'decimals' => 18],
    ];

    protected function setUp(): void
    {
        parent::setUp();
        $this->tokenService = new TokenService();
        $this->artisan('migrate:fresh');
        DB::statement('DELETE FROM addresses');
        DB::statement('DELETE FROM token_contracts');
    }

    public function testGetTenReturnsCorrectNumberOfTokens()
    {
        // Arrange
        $this->createTokenContracts();

        // Act
        $result = $this->tokenService->getTen();

        // Assert
        $this->assertCount(10, $result);
        $this->assertInstanceOf(\Illuminate\Http\Resources\Json\AnonymousResourceCollection::class, $result);
    }

    public function testGetTenIncludesAddressRelation()
    {
        // Arrange
        $this->createTokenContracts();

        // Act
        $result = $this->tokenService->getTen();

        // Assert
        $this->assertCount(10, $result);
        foreach ($result as $tokenResource) {
            $this->assertArrayHasKey('address', $tokenResource);
        }
    }

    public function testGetTenReturnsEmptyCollectionWhenNoTokens()
    {
        // Act
        $result = $this->tokenService->getTen();

        // Assert
        $this->assertCount(0, $result);
        $this->assertInstanceOf(\Illuminate\Http\Resources\Json\AnonymousResourceCollection::class, $result);
    }

    private function createTokenContracts(): void
    {
        foreach ($this->defaultTokens as $index => &$token) {
            $address = Address::create([
                'address' => $token['token_address']
            ]);

            TokenContract::create([
                'token_address_id' => $address->id,
                'name' => $token['name'],
                'symbol' => $token['symbol'],
                'decimals' => $token['decimals'],
            ]);
        }
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }
}


            /*$tokenContract = new TokenContract();
            $tokenContract->token_address_id = $index + 1;
            $tokenContract->address = (object) ['address' => $token['token_address']];
            $tokenContract->name = $token['name'];
            $tokenContract->symbol = $token['symbol'];
            $tokenContract->decimals = $token['decimals'];
            $tokenContract->created_at = now();
            $tokenContract->updated_at = now();
            $tokenContract->save();*/


/*
        $mockData = new stdClass();
        $mockData->id = 1;
        $mockData->created_at = '2025-02-10 06:00:00';
        $mockData->updated_at = '2025-02-10 06:30:00';
        $mockData->token_address_id = 123;
        $mockData->name = 'Test Token';
        $mockData->symbol = 'TTK';
        $mockData->decimals = 18;
        $mockData->address = (object) ['address' => '0x123456789abcdef'];

    public function getAll(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection // \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $tokens = TokenContract::with('address')->take(10)->get();
        TokenContractResource::withoutWrapping(); // destructuring the resource so no such end format : { data : contract array }
        return TokenContractResource::collection($tokens);
    }
    
    protected $fillable = [
        'token_address_id',
        'name',
        'symbol',
        'decimals',
    ];

            $resultTokensMock = [
            ['name' => 'CrystalDrive', 'symbol' => 'CRD', 'token_address_id' => 0, 'decimals' => 18],
            ['name' => 'CyberSpark', 'symbol' => 'CSP', 'token_address_id' => 1, 'decimals' => 18],
            ['name' => 'EchoChain', 'symbol' => 'ECH', 'token_address_id' => 2, 'decimals' => 18],
            ['name' => 'NeoNova', 'symbol' => 'NOV', 'token_address_id' => 3, 'decimals' => 18],
            ['name' => 'PrimeFlow', 'symbol' => 'PRM', 'token_address_id' => 4, 'decimals' => 18],
            ['name' => 'Quantum', 'symbol' => 'QTM', 'token_address_id' => 5, 'decimals' => 18],
            ['name' => 'StellarPulse', 'symbol' => 'STP', 'token_address_id' => 6, 'decimals' => 18],
            ['name' => 'VertexCoin', 'symbol' => 'VTX', 'token_address_id' => 7, 'decimals' => 18],
            ['name' => 'ZenithToken', 'symbol' => 'ZNT', 'token_address_id' => 8, 'decimals' => 18],
            ['name' => 'SolarFlare', 'symbol' => 'SFL', 'token_address_id' => 9, 'decimals' => 18],
            ['name' => 'NimbusNet', 'symbol' => 'NMB', 'token_address_id' => 10, 'decimals' => 18],
        ];

*/

        /*$this->app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => storage_path('testing.sqlite'),
            'prefix' => '',
        ]);*/
        /*$this->app['config']->set('database.default', 'sqlite');
        $this->app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);*/