<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Domain\Billing\Models\Price;
use Illuminate\Http\Request;
class PriceController extends Controller {
    public function index() { return Price::all(); }
    public function update(Price $price, Request $req) {
        $price->update($req->only(['unit','unit_price_minor','meta']));
        return $price;
    }
}