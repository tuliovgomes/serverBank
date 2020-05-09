<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class HelpersTest extends TestCase
{
    public function test_custom_token()
    {
        $token = custom_token('test', 40);

        $this->assertStringStartsWith('test_', $token);
        $this->assertEquals(40, strlen($token));
    }

    public function test_required_to_sometimes()
    {
        $rules = [
            'field' => 'required|foo',
            'another_field' => [
                'required',
                'bar',
            ],
        ];

        $newRules = required_to_sometimes($rules);
  
        $this->assertEquals('sometimes|foo', $newRules['field']);
        $this->assertContains('sometimes', $newRules['another_field']);
    }

    public function test_only_numbers()
    {
        $this->assertEquals(123, only_numbers('123 '));
        $this->assertEquals(123, only_numbers('123aaafooobbb'));
        $this->assertEquals(123, only_numbers('___!@#123'));
        $this->assertEquals(123123123, only_numbers('123  123    123'));
        $this->assertEquals(123123123, only_numbers('123-123-123'));
    }

    public function test_decimal_to_cents()
    {
        $this->assertEquals(100, decimal_to_cents(1.0));
        $this->assertEquals(100, decimal_to_cents(1));
        $this->assertEquals(12345, decimal_to_cents(123.45));
    }

    public function test_cents_to_decimal()
    {
        $this->assertEquals(1.0, cents_to_decimal(100));
        $this->assertEquals(1.23, cents_to_decimal(123));
        $this->assertEquals(100.50, cents_to_decimal(10050));
    }
}
