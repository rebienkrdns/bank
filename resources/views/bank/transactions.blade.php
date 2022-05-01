<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h4 class="py-2">Transacciones</h4>
                @if(count($transactions))
                <table id="example" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Fecha y hora</th>
                            <th>Cuenta de origen</th>
                            <th>Cuenta de destino</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>{{ $item->origin }}</td>
                            <td>{{ $item->destination }}</td>
                            <td>{{ $item->value }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Fecha y hora</th>
                            <th>Cuenta de origen</th>
                            <th>Cuenta de destino</th>
                            <th>Valor</th>
                        </tr>
                    </tfoot>
                </table>
                <script>
                    $(document).ready(function() {
                        $('#example').DataTable();
                    });
                </script>
                @else
                <div class="mb-4 font-medium text-red-600">Ops, No hay transacciones por mostrar!</div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>