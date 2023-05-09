<x-app-layout >
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-blue-100 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-black-900 dark:text-gray-100">

                    <h1 class="text-xl font-semibold">LISTA DE MUSICAS  </h1>


                    <fieldset class="border p-2 mb-2 border-violet-500 rounded">
                        <legend class="text-xl px-2 border rounded-md border-violet-700">Adicione Musicas</legend>

                        <form action="{{ route('music.store') }}" method="POST" class="mt-2">
                            @csrf

                            <div class="mt-4">
                                <x-input-label for="nome" :value="__('Nome da Musica')" class=" text-xl"/>
                                <x-text-input id="nome" class="block mt-1 w-full" type="text" name="nome" required />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="cantor" :value="__('Cantor')" class=" text-xl" />
                                <x-text-input id="cantor" class="block mt-1 w-full" type="text" name="cantor" required />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="genero" :value="__('Genero Musical')" class="text-xl" ></x-input-label>
                                <select required name="genero">
                                    <option value="-">-</option>
                                    <option value="rock">Rock</option>
                                    <option value="pop">POP</option>
                                    <option value="Eletronica">Eletronica</option>
                                    <option value="indie">Indie</option>
                                </select>
                            </div>

                            <br>
                            <x-primary-button class="w-full bg-blue-600"> Adicionar </x-primary-button>
                        </form>
                    </fieldset>

                    <br>
                    <h1 class="text-xl font-semibold"> Minhas Musicas: </h1>

                    <br>

                    @foreach(Auth::user()->myMusics as $music)

                    <div class="flex justify-between border-b mb-2 gap-4 
                    hover:bg-yellow-100" x-data=" { showDelete: false, showEdit: false  } ">

                    <div class="flex justify-between flex-grow ">
                        <div>
                        Nome:{{ $music -> nome }} <br>
                        Autor: {{ $music -> cantor }} <br>
                        Genero:{{ $music -> genero }} 
                        </div> 
                    </div>
        
                        <div class="flex gap-2">
                            <div>
                                <span class="cursor-pointer px-2 bg-red-500 px-2 border rounded-md text-white" @click="showDelete = true "> Deletar </span>
                            </div>
                            <div>
                                <span class="cursor-pointer px-2 bg-violet-500 px-2 border rounded-md text-white" @click="showEdit = true "> Editar </span>
                            </div>
                        </div>

                        <template x-if="showDelete">
                            <div class="absolute top-0 button-0 left-0 right-0 bg-gray-800 bg-opacity-20 z-0">
                                <div class="w-96 bg-violet-200 p-4 absolute left-1/4 right-1/4 top-1/4 z-10 ">

                                    <h2 class="text-xl font-bold text-center">Tem certeza que deseja apagar essa música?</h2>

                                    <div class="flex justify-between mt-4">
                                        <form action="{{  route('music.destroy', $music) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <x-danger-button class="bg-red-500" > Deletar </x-danger-button>
                                        </form>
                                        <x-primary-button class="bg-violet-900" @click="showDelete = false"> Cancelar </x-primary-button>
                                    </div>
                                </div>
                            </div>
                        </template>

                        <template x-if="showEdit">
                            <div class="absolute top-0 button-0 left-0 right-0 bg-gray-800 bg-opacity-20 z-0">
                                <div class="w-96 bg-violet-200 p-4 absolute left-1/4 right-1/4 top-1/4 z-10 ">

                                    <h2 class="text-xl font-bold text-center">{{ $music->nome }}</h2>
                                    
                                    <form class="my-4" action="{{  route('music.update', $music) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <x-text-input name="nome" placeholder="Nome" value="{{ $music->nome }}" required></x-text-input>
                                        <x-text-input name="cantor" placeholder="Cantor" value="{{ $music-> autor }}" required></x-text-input>
                                        <x-input-label for="genero" :value="__('Genero Musical')" class="text-xl" ></x-input-label>
                                            <select required name="genero">
                                                <option value="-">-</option>
                                                <option value="rock">Rock</option>
                                                <option value="pop">POP</option>
                                                <option value="Eletronica">Eletronica</option>
                                                <option value="indie">Indie</option>
                                            </select>

                                        <x-primary-button class="bg-violet-500"> Editar </x-primary-button>
                                    </form>
                                    <x-primary-button @click="showEdit = false" class="bg-violet-900"> Cancelar </x-primary-button>
                                </div>
                            </div>
                        </template>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>