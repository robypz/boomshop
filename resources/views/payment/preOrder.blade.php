<div class="row lh-sm">
    <div class="col">
        <div class="row">
            <div class="col text-center">
                <p class="text-primary">
                    <span class="fw-bold">Producto:</span><br>
                    <span class="footer-title" id="product"> {{ $bundle->product->name }}</span>
                </p>

            </div>
        </div>
    </div>

    <div class="col">
        <div class="row">
            <div class="col text-center">
                <p class=" text-primary">
                    <span class="fw-bold">Paquete:</span><br>
                    <span class="footer-title">{{ $bundle->content }}</span>
                </p>

            </div>
        </div>
    </div>

    <div class="col">
        <div class="row">
            <div class="col">
                <p class=" text-primary text-center">
                    <span class="fw-bold">Precio:</span> <br>
                    <span class="footer-title">{{ $bundle->price }} $</span>

                </p>

            </div>
        </div>
    </div>
    @if ($bundle->discount > 0)
        <div class="col">
            <div class="row">
                <div class="col text-center">
                    <p class=" text-primary">
                        <span class="fw-bold">Descuento: </span> <br>
                        <span class="footer-title">{{ $bundle->discount }} %</span>

                    </p>

                </div>
            </div>
        </div>
    @endif

</div>
