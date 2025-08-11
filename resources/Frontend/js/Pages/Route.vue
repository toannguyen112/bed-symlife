<template>
    <main class="container mx-auto">
        <table class="table">
            <thead>
                <tr>
                    <th class="p-2 border">Method</th>
                    <th class="p-2 border">URI</th>
                    <th class="p-2 border">Name</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, name) of routes()">
                    <td class="p-2 border">{{ item.methods }}</td>
                    <td class="p-2 border">
                        <a :href="item.uri.includes('{') ? '#' : route(name, {}, false)" target="_blank" class="link">
                            {{ item.uri }}
                        </a>
                    </td>
                    <td class="p-2 border">{{ name }}</td>
                </tr>
            </tbody>
        </table>
    </main>
</template>
