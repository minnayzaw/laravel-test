<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    // return one level of child items
   public function items()
   {
       return $this->hasMany(Item::class, 'parent_id');
   }

   // recursive relationship
   public function childItems()
   {
       return $this->hasMany(Item::class, 'parent_id')->with('items');
   }
}
