<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use \Illuminate\Support\Str;

class NotebookControllerTest extends TestCase
{
    public function testStoreMethod() {
        $this->post('dashboard/notebooks', [
            'name' => Str::random(),
            'notebook_type' => 'todo',
            'price' => rand(0,4000),
            'discount' => rand(0,100),
            'quantity' => rand(0,100),
            'page_count' => rand(0,50),
            'page_weight' => rand(0,50),
            'width' => rand(0,50),
            'height' => rand(0,50),
            'main_picture' => '0XTakOnFe1rF8antUaq2M7Cy1RWRSgG9Mx2NtR1U.png',
            'other_pictures' => [
                'buqjDk6jMWCyBT545kRdGhpkS7Aw8KrKR5phfu67.png',
                'fsyqIIAQVLRLYK9JtdTQEF08gEnuWfRhogQFxyZ8.png',
                'LK3uTDKDca0t9bFAIOh9GmT7nDZPfe1bSf1t1FQk.png'
            ]
        ]);

        
    }
}
