<div>
    <h6 class="text-uppercase mt-4">{{ ucfirst(__('my-crm::lang.delivery_details')) }}</h6>
    <hr />
    @include('my-crm::partials.form.select',[
        'name' => 'delivery_type',
        'label' => ucfirst(__('my-crm::lang.type')),
        'options' => [
            'deliver' => 'Deliver',  
            'pickup' => 'Pickup',    
        ],
        'value' => old('delivery_type', $purchaseOrder->delivery_type ?? 'deliver'),
        'attributes' => [
            'wire:model.change' => 'deliveryType',
        ]
    ])
    @if($deliveryType == 'deliver')
        
        @if(isset($purchaseOrder))
            <div class="row">
                <div class="col-sm-6">
                    @include('my-crm::partials.form.text',[
                         'name' => 'address_contact',
                         'label' => ucfirst(__('my-crm::lang.contact_name')),
                         'value' => old('reference', $purchaseOrder->address->contact ?? null)
                     ])
                </div>
                <div class="col-sm-6">
                    @include('my-crm::partials.form.text',[
                        'name' => 'address_phone',
                        'label' => ucfirst(__('my-crm::lang.contact_phone')),
                        'value' => old('address_phone', $purchaseOrder->address->phone ?? null)
                    ])
                </div>
            </div>
    
            @include('my-crm::partials.form.text',[
                'name' => 'address_line1',
                'label' => ucfirst(__('my-crm::lang.line_1')),
                'value' => old('address_line1', $purchaseOrder->address->line1 ?? null)
            ])
    
            @include('my-crm::partials.form.text',[
                    'name' => 'address_line2',
                    'label' => ucfirst(__('my-crm::lang.line_2')),
                    'value' => old('address_line2', $purchaseOrder->address->line2 ?? null)
                ])
    
            @include('my-crm::partials.form.text',[
                    'name' => 'address_line3',
                    'label' => ucfirst(__('my-crm::lang.line_3')),
                    'value' => old('address_line3', $purchaseOrder->address->line3 ?? null)
                ])
    
            <div class="row">
                <div class="col-sm-6">
                    @include('my-crm::partials.form.text',[
                        'name' => 'address_city',
                        'label' => ucfirst(__('my-crm::lang.suburb')),
                        'value' => old('address_city', $purchaseOrder->address->city ?? null)
                    ])
                </div>
                <div class="col-sm-6">
                    @include('my-crm::partials.form.text',[
                        'name' => 'address_state',
                        'label' => ucfirst(__('my-crm::lang.state')),
                        'value' => old('address_state', $purchaseOrder->address->state ?? null)
                    ])
                </div>
            </div>
    
            <div class="row">
                <div class="col-sm-6">
                    @include('my-crm::partials.form.text',[
                        'name' => 'address_code',
                        'label' => ucfirst(__('my-crm::lang.postcode')),
                        'value' => old('address_code', $purchaseOrder->address->code ?? null)
                    ])
                </div>
                <div class="col-sm-6">
                    @include('my-crm::partials.form.select',[
                         'name' => 'address_country',
                         'label' => ucfirst(__('my-crm::lang.country')),
                         'options' => ['' => ''] + \Kv\MyCrm\Http\Helpers\SelectOptions\countries(),
                         'value' => old('address_country', $purchaseOrder->address->country ?? null)
                     ])
                </div>
            </div>
        @else
            @include('my-crm::partials.form.select',[
                 'name' => 'delivery_address',
                 'label' => ucfirst(__('my-crm::lang.delivery_address')),
                 'options' => ['' => ''] + $addresses,
                 'value' => old('delivery_address')
             ])
        @endif
        @include('my-crm::partials.form.textarea',[
             'name' => 'delivery_instructions',
             'label' => ucfirst(__('my-crm::lang.delivery_instructions')),
             'rows' => 5,
             'value' => old('delivery_instructions', $purchaseOrder->delivery_instructions ?? $purchaseOrderDeliveryInstructions->value ??  null)
        ])
    @endif
</div>