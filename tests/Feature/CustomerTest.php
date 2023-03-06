<?php

namespace Tests\Feature;

use App\Http\Controllers\CustomersController;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use App\Repositories\Eloquent\CustomerRepository;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Request;
use Mockery;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $response = $this->get('/api/customers');
        $this->assertEquals(200, $response->getStatusCode());
    }
    public function testStore()
    {
        // Crie um registro de cliente no banco de dados
        $customer = Customer::factory()->create();
        $data = [
            'name' => $customer->name,
            'cpf' => $customer->cpf,
            'phone' => $customer->phone,
            'birthday' => $customer->birthday,
        ];
        $customer->delete();
        // Faça uma requisição POST para o endpoint /api/customers
        $response = $this->post('/api/customers', $data);
        // Verifique se o status da resposta é 201 (OK)

        $response->assertStatus(201);
        $this->assertDatabaseHas('customers', $data);

    }
    public function testShow()
    {
        $customer = Customer::factory()->create();

        // Faça uma requisição GET para o endpoint /customers/{id}
        $response = $this->get('/api/customers/' . $customer->id);

        // Verifique se o status da resposta é 200 (OK)
        $response->assertStatus(200);

        // Verifique se o corpo da resposta contém os dados do registro de cliente
        $response->assertJson([
            'data' => [
                'id' => $customer->id,
                'name' => $customer->name,
                'cpf' => $customer->cpf,
                'phone' => $customer->phone,
                'birthday' => $customer->birthday,
                // Inclua outros campos, se houver
            ],
            "message" => "Customer successfully recovered.",
            "status" => 200
        ]);
    }
    public function testDestroy()
    {
        // Create a customer record to delete
        $customer = Customer::factory()->create();


        // Send a DELETE request to the destroy endpoint
        $response = $this->delete("/api/customers/{$customer->id}");

        // Check if the response has a 200 status code
        $response->assertStatus(200);

        // Check if the response has the expected JSON structure
        $response->assertJson([
            'data' => [
                'id' => $customer->id,
                'name' => $customer->name,
                'cpf' => $customer->cpf,
                'phone' => $customer->phone,
                'birthday' => $customer->birthday,
                // Inclua outros campos, se houver
            ],
            "message" => "Customer successfully recovered.",
            "status" => 200
        ]);

        // Checar se o customer foi deletado
        $this->assertDatabaseMissing('customers', [
            'id' => $customer->id,
        ]);
    }

    public function testUpdate()
    {
        // Create a customer in the database
        $customer = Customer::factory()->create();

        // Update the customer's name and phone
        $data = [
            'name' => $customer->name,
            'cpf' => $customer->cpf,
            'phone' => $customer->phone,
            'birthday' => $customer->birthday,
        ];

        $response = $this->put('/api/customers/' . $customer->id, $data);

        $response->assertStatus(200); // Verifica se o status da resposta é 200 (OK)
        $this->assertDatabaseHas('customers', [
            'id' => $customer->id,
            'cpf' => $customer->cpf,
            'name' => $customer->name,
            'phone' => $customer->phone,
            'birthday' => $customer->birthday,
        ]); // Verifica se o registro foi atualizado no banco de dados
    }
}