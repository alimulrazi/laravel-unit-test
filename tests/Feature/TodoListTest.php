<?php

namespace Tests\Feature;

use App\Models\TodoList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoListTest extends TestCase
{
    use RefreshDatabase;
    /*
    * Every test has 3 phases
    * 1. Preparation / Prepare
    * 2. Action / Perform
    * 3. Assertions / Predict
    */

    private $todo;

    public function setUp(): void
    {
        parent::setUp();
        $this->todo = TodoList::factory()->create(['name'=>'my list']);
    }

    public function test_fetch_all_todo()
    {
       /*Preparation / Prepare */
       //TodoList::create(['name'=>'My list']);
       //TodoList::factory()->create(['name'=>'my list']);

       /* Action / Perform */
       $response = $this->getJson(route('todo-list.index'));

       /* Assertions / Predict */
       $this->assertEquals(1, count($response->json()));
       $this->assertEquals('my list', $response[0]['name']);
       //$this->assertTrue(true);
    }

    public function test_fetch_single_todo(){
        //preparation
        //$todo = TodoList::factory()->create(['name'=>'my list']);

        //action
        $response = $this->getJson(route('todo-list.show', $this->todo->id))
                    ->assertOk()
                    ->json();

        //assertion
        //$response->assertStatus(200);
        //$response->assertOk();
        //$this->assertEquals($response->json()['name'], $this->todo->name);
        $this->assertEquals($response['name'], $this->todo->name);
    }

    public function test_store_todo_list(){
        //preparation
        $todo = TodoList::factory()->make();
        //action
        $response = $this->postJson(route('todo-list.store'), ['name'=>$todo->name])
             ->assertCreated()
             ->json();

        //assertion
        $this->assertEquals($todo->name, $response['name']);
        $this->assertDatabaseHas('todo_lists', ['name'=>$todo->name]);
    }

    public function test_while_storing_todo_list_name_field_is_required()
    {
        $this->withExceptionHandling();

       $response = $this->postJson(route('todo-list.store'))
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['name']);
    }

    public function test_delete_todo_list()
    {
        $this->deleteJson(route('todo-list.destroy', $this->todo->id))
            ->assertNoContent();

        $this->assertDatabaseMissing('todo_lists', ['name' => $this->todo->name]);
    }

    public function test_update_todo_list()
    {
        //preparation

        //action
        $this->patchJson(route('todo-list.update', [$this->todo->id]), ['name'=>'updated name'])
        ->assertOk();

        //assertion
        $this->assertDatabaseHas('todo_lists', ['id'=>$this->todo->id, 'name'=>'updated name']);
    }

    public function test_while_updating_todo_list_name_field_is_required()
    {
        $this->withExceptionHandling();

       $response = $this->patchJson(route('todo-list.update', $this->todo->id))
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['name']);
    }
}
