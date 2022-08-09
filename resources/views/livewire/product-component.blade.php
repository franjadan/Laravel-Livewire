<div>
    <div class="row">
        <div class="col-md-8">

            @if(isset($success_text) || isset($error_text))
                <div class="mt-3">
                    @if(isset($success_text))
                        <div class="alert alert-success" role="alert">
                            {{ $success_text }}
                        </div>
                    @endif

                    @if(isset($error_text))
                        <div class="alert alert-danger" role="alert">
                            {{ $error_text }}
                        </div>
                    @endif
                </div>
            @endif

            <div class="mt-3">
                <button class="btn btn-primary" wire:click="create">Nuevo producto</button>
            </div>

            <div class="mt-2 table-responsive-md">
                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Acción</th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->description }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>${{ $product->price }} MXN</td>
                                <td>
                                    <button type="button" class="btn btn-success" wire:click='edit({{ $product }})'>Editar</button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger" wire:click='destroy({{ $product }})'>Borrar</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $products->links('pagination::Bootstrap-4') }}
            </div>
        </div>
        <div class="col-md-4">
            @if(isset($view))
                <div class="container">
                    @include("livewire.$view")
                </div>
            @endif
        </div>
    </div>
</div>
