<?php

namespace Database\Seeders;

use GetCandy\FieldTypes\Text;
use GetCandy\FieldTypes\TranslatedText;
use GetCandy\Hub\Models\Staff;
use GetCandy\Models\Attribute;
use GetCandy\Models\AttributeGroup;
use GetCandy\Models\Channel;
use GetCandy\Models\Collection;
use GetCandy\Models\CollectionGroup;
use GetCandy\Models\Country;
use GetCandy\Models\Currency;
use GetCandy\Models\CustomerGroup;
use GetCandy\Models\Language;
use GetCandy\Models\Price;
use GetCandy\Models\Product;
use GetCandy\Models\ProductOption;
use GetCandy\Models\ProductType;
use GetCandy\Models\ProductVariant;
use GetCandy\Models\TaxClass;
use GetCandy\Models\TaxZone;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LunaCatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(
            function () {
                Log::info('Installing GetCandy...');

                Log::info('Publishing hub assets');

                if (! Country::count()) {
                    Log::info('Importing countries');
                    Artisan::call('getcandy:import:address-data');
                }

                if (! Channel::whereDefault(true)->exists()) {
                    Log::info('Setting up default channel');

                    Channel::create(
                        [
                            'name' => 'Webstore',
                            'handle' => 'webstore',
                            'default' => true,
                            'url' => 'localhost',
                        ]
                    );
                }

                if (! Staff::whereAdmin(true)->exists()) {
                    Log::info('Create an admin user');

                    Staff::create(
                        [
                            'firstname' => 'Luna',
                            'lastname' => 'Cat',
                            'email' => 'admin@lunacat.com',
                            'password' => bcrypt('kWt3j#r#VHS%'),
                            'admin' => true,
                        ]
                    );
                }

                if (! Language::count()) {
                    Log::info('Adding default language');

                    Language::create(
                        [
                            'code' => 'en',
                            'name' => 'English',
                            'default' => true,
                        ],

                    );
                    Language::create(
                        [
                            'code' => 'hu',
                            'name' => 'Hungarian',
                            'default' => false,
                        ]
                    );
                }

                if (! Currency::whereDefault(true)->exists()) {
                    Log::info('Adding a default currency (USD)');

                    Currency::create(
                        [
                            'code' => 'USD',
                            'name' => 'US Dollar',
                            'exchange_rate' => 1,
                            'decimal_places' => 2,
                            'default' => true,
                            'enabled' => true,
                        ]
                    );
                    Currency::create(
                        [
                            'code' => 'HUF',
                            'name' => 'Hungarian Forint',
                            'exchange_rate' => 400,
                            'decimal_places' => 0,
                            'default' => false,
                            'enabled' => true,
                        ]
                    );
                }

                if (! CustomerGroup::whereDefault(true)->exists()) {
                    Log::info('Adding a default customer group.');

                    CustomerGroup::create(
                        [
                            'name' => 'Retail',
                            'handle' => 'retail',
                            'default' => true,
                        ]
                    );
                }

                if (! CollectionGroup::count()) {
                    Log::info('Adding an initial collection group');

                    CollectionGroup::create(
                        [
                            'name' => 'Main',
                            'handle' => 'main',
                        ]
                    );
                }

                if (! TaxClass::count()) {
                    Log::info('Adding a default tax class.');

                    TaxClass::create(
                        [
                            'name' => 'Default Tax Class',
                            'default' => true,
                        ]
                    );
                }

                if (! Attribute::count()) {
                    Log::info('Setting up initial attributes');

                    $group = AttributeGroup::create(
                        [
                            'attributable_type' => Product::class,
                            'name' => collect(
                                [
                                    'en' => 'Details',
                                ],
                                [
                                    'hu' => 'Részletek',
                                ]
                            ),
                            'handle' => 'details',
                            'position' => 1,
                        ]
                    );

                    $collectionGroup = AttributeGroup::create(
                        [
                            'attributable_type' => Collection::class,
                            'name' => collect(
                                [
                                    'en' => 'Details',
                                ],
                                [
                                    'hu' => 'Részletek',
                                ]
                            ),
                            'handle' => 'collection_details',
                            'position' => 1,
                        ]
                    );

                    Attribute::create(
                        [
                            'attribute_type' => Product::class,
                            'attribute_group_id' => $group->id,
                            'position' => 1,
                            'name' => [
                                [
                                    'en' => 'Name',
                                ],
                                [
                                    'hu' => 'Név',
                                ],
                            ],
                            'handle' => 'name',
                            'section' => 'main',
                            'type' => TranslatedText::class,
                            'required' => true,
                            'default_value' => null,
                            'configuration' => [
                                'richtext' => false,
                            ],
                            'system' => true,
                        ]
                    );

                    Attribute::create(
                        [
                            'attribute_type' => Collection::class,
                            'attribute_group_id' => $collectionGroup->id,
                            'position' => 1,
                            'name' => [
                                [
                                    'en' => 'Name',
                                ],
                                [
                                    'hu' => 'Név',
                                ],
                            ],
                            'handle' => 'name',
                            'section' => 'main',
                            'type' => TranslatedText::class,
                            'required' => true,
                            'default_value' => null,
                            'configuration' => [
                                'richtext' => false,
                            ],
                            'system' => true,
                        ]
                    );

                    Attribute::create(
                        [
                            'attribute_type' => Product::class,
                            'attribute_group_id' => $group->id,
                            'position' => 2,
                            'name' => [
                                [
                                    'en' => 'Description',
                                ],
                                [
                                    'hu' => 'Leírás',
                                ],
                            ],
                            'handle' => 'description',
                            'section' => 'main',
                            'type' => TranslatedText::class,
                            'required' => false,
                            'default_value' => null,
                            'configuration' => [
                                'richtext' => true,
                            ],
                            'system' => false,
                        ]
                    );

                    Attribute::create(
                        [
                            'attribute_type' => Collection::class,
                            'attribute_group_id' => $collectionGroup->id,
                            'position' => 2,
                            'name' => [
                                [
                                    'en' => 'Description',
                                ],
                                [
                                    'hu' => 'Leírás',
                                ],
                            ],
                            'handle' => 'description',
                            'section' => 'main',
                            'type' => TranslatedText::class,
                            'required' => false,
                            'default_value' => null,
                            'configuration' => [
                                'richtext' => true,
                            ],
                            'system' => false,
                        ]
                    );
                }

                if (! ProductType::count()) {
                    Log::info('Adding a product type.');

                    $type = ProductType::create(
                        [
                            'name' => 'Sticker',
                        ]
                    );

                    $type->mappedAttributes()->attach(
                        Attribute::whereAttributeType(Product::class)->get()->pluck('id')
                    );
                }

                if (! Product::count()) {
                    Log::info('Adding products.');

                    $description = "Toy mouse squeak roll over spit up on light gray carpet instead of adjacent linoleum for get my claw stuck in the dog's ear. Run up and down stairs kitty loves pigs. Your pillow is now my pet bed i will be pet i will be pet and then i will hiss yet tuxedo cats always looking dapper scream at teh bath. Destroy couch chase ball of string do not try to mix old food with new one to fool me! sleep nap but see owner, run in terror sleep in the bathroom sink.";

                    $option = ProductOption::create(
                        [
                            'name' => [
                                'en' => 'Colour',
                            ],
                        ]
                    );

                    $redOption = $option->values()->create(
                        [
                            'name' => [
                                'en' => 'Red',
                            ],
                        ]
                    );
                    $taxZone = TaxZone::create(
                        [
                            'name' => 'UK',
                            'zone_type' => 'country',
                            'price_display' => 'tax_inclusive',
                            'active' => true,
                            'default' => true,
                        ]
                    );

                    $taxClass = TaxClass::create(
                        [
                            'name' => 'Telegram Stickers',
                        ]
                    );

                    // for ($i = 0; $i < 48; $i++) {
                    //     $product = Product::create(
                    //         [
                    //             'product_type_id' => 1,
                    //             'status' => 'published',
                    //             'brand' => 'LunaCat Inc.',
                    //             'attribute_data' => [
                    //                 'name' => new TranslatedText(
                    //                     collect(
                    //                         [
                    //                             'en' => new Text('LunaCAt Sticker - ', $i++),
                    //                         ]
                    //                     )
                    //                 ),
                    //                 'description' => new Text($description),
                    //             ],
                    //         ]
                    //     );
                    // $redVariant = ProductVariant::create(
                    //     [
                    //         'product_id' => $product->id,
                    //         'tax_class_id' => $taxClass->id,
                    //         'sku' => 'red-product-'.$product->id,
                    //     ]
                    // );

                    // $redVariant->values()->attach($redOption);

                    // $price = Price::create([
                    //     'price' => 199,
                    //     'compare_price' => 299,
                    //     'currency_id' => 1,
                    //     'tier' => 1,
                    //     'customer_group_id' => null,
                    //     'priceable_type' => 'GetCandy\Models\ProductVariant',
                    //     'priceable_id' => 1,
                    // ]);
                    // }
                }

                Log::info('GetCandy is now installed.');
            }
        );
    }
}
