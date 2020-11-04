<div class="w-full p-6">
    <form action="{{ route('card-charge') }}" method="POST" id="payment-form">
        @csrf
        <input type="hidden" name="token_id" id="token_id">
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="holder_name">
                Tirular de la tarjeta
            </label>
            <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                type="text" placeholder="Como aparece en la tarjeta" autocomplete="off"
                data-openpay-card="holder_name">
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="card_number">
                Numero de la tarjeta
            </label>
            <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                type="text" autocomplete="off" data-openpay-card="card_number"
                placeholder="1234-5678-1234-5678">
        </div>
        <div class="flex content-start flex-wrap mb-3">
            <div class="w-1/3 mr-1">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="card_number">
                    Mes
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                    type="text" placeholder="Mes" data-openpay-card="expiration_month">
            </div>
            <div class="w-1/3 mr-1">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="card_number">
                    Año
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                    type="text" placeholder="Año" data-openpay-card="expiration_year">
            </div>
            <div class="w-1/4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="card_number">
                    CCV
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                    type="text" placeholder="3 dígitos" autocomplete="off" data-openpay-card="cvv2">
            </div>
        </div>
        <div class="grid grid-cols-1 place-items-end">
            <a id="pay-button" class="bg-green-700 text-white hover:bg-green-800 rounded-lg p-2"
                id="pay-button">Pagar</a>
        </div>
    </form>
    <p class="text-center text-gray-500 text-xs">
        Tus pagos se realizan de forma segura con encriptación de 256 bits
    </p>
</div>