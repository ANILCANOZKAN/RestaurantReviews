<x-layout>
    <section class="py-8 max-w-4xl mx-auto">
        <h1 class="text-lg font-bold mb-8 pb-2 border-b">
            Administiration Section
        </h1>
        <div class="flex">
            <aside class="w-48">
                <h4 class="font-semibold mb-4 ">
                    Options
                </h4>
                <ul>
                    <li>
                        <a href="/admin/section/restaurants" class="{{ request()->is('admin/section/restaurants') ? 'text-blue-500' : ''  }}">Restaurants</a>
                    </li>
                    <li>
                        <a href="/admin/section/users" class="{{ request()->is('admin/section/users') ? 'text-blue-500' : ''  }}">Users</a>
                    </li>
                </ul>
            </aside>
            <main class="flex-1">
                <div class="container ml-8">
                    <table>
                        <thead>
                        <tr>
                            <th>Adı</th>
                            <th>Rating</th>
                            <th>Sahibi</th>
                        </tr>
                        </thead>
                        @foreach($restaurants as $restaurant)
                            @php( $user_name = \App\Models\User::firstWhere('id', $restaurant->user_id)->name
)
                        <tbody class="border-b">
                        <tr>
                            <td>{{ $restaurant->name }}</td>
                            <td>{{ $restaurant->overall_like }}</td>
                            <td> <a href="/restaurant{{ $restaurant->slug }}">{{ $user_name }}</a></td>
                            <td>
                            <a class="rounded-xl bg-red-500 text-white p-1 hover:bg-red-600" href="/delete/restaurant/{{ $restaurant->slug }}">Delete</a>
                            </td>
                        </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
            <style>
                table {
                    width: 800px;
                    border-collapse: collapse;
                    overflow: hidden;
                    box-shadow: 0 0 20px rgba(0,0,0,0.1);
                }

                th,
                td {
                    padding: 15px;
                    background-color: rgba(255,255,255,0.2);
                    color: #1a202c;
                }

                th {
                    text-align: left;
                }

                thead {
                th {
                    background-color: #55608f;
                }
                }

                tbody {
                tr {
                &:hover {
                     background-color: rgba(255,255,255,0.3);
                 }
                }
                td {
                    position: relative;
                &:hover {
                &:before {
                     content: "";
                     position: absolute;
                     left: 0;
                     right: 0;
                     top: -9999px;
                     bottom: -9999px;
                     background-color: rgba(255,255,255,0.2);
                     z-index: -1;
                 }
                }
                }
                }
            </style>
            </main>
        </div>
    </section>
</x-layout>
