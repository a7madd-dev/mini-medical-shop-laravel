<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\ProductLog;
use Illuminate\Support\Facades\Auth;

class ProductObserver
    {
        public function created(Product $product)
        {
            ProductLog::create([
                'product_id' => $product->id,
                'action' => 'created',
                'changed_by' => Auth::id(),
                'changes' => $product->toArray(),
            ]);
        }

        public function updated(Product $product)
        {
            ProductLog::create([
                'product_id' => $product->id,
                'action' => 'updated',
                'changed_by' => Auth::id(),
                'changes' => [
                    'old' => $product->getOriginal(),
                    'new' => $product->getChanges(),
                ],
            ]);
        }

        public function deleted(Product $product)
        {
            ProductLog::create([
                'product_id' => $product->id,
                'action' => 'deleted',
                'changed_by' => Auth::id(),
                'changes' => $product->toArray(),
            ]);
        }
    }
