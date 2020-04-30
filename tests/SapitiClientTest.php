<?php


use Sapiti\SapitiClient;
use PHPUnit\Framework\TestCase;

class SapitiClientTest extends TestCase
{
	public function testConstructor()
	{
		self::assertInstanceOf(SapitiClient::class, new SapitiClient('',''));
	}
}
