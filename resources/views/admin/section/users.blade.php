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
                <main class="flex-1">
                    <div class="container ml-8">
                        <table>
                            <thead>
                            <tr>
                                <th>Adı</th>
                                <th>Email</th>
                                <th>Rol</th>
                            </tr>
                            </thead>
                            @foreach($users as $user)
                                <tbody class="border-b">
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    @if($user->role == 0)
                                    <td>{{ 'Kullanıcı' }}</td>
                                    @elseif($user->role == 1)
                                        <td>{{ 'Restoran sahibi' }}</td>
                                    @else
                                        <td>{{ 'Admin' }}</td>
                                    @endif
                                    <td>
                                        <a class="rounded-xl bg-red-500 text-white p-1 hover:bg-red-600" href="/delete/user/{{ $user->email }}">Delete</a>
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
            </main>
        </div>
    </section>
</x-layout>
