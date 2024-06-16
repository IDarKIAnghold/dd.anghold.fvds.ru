import { defineStore } from "pinia";
import { usePage } from "@inertiajs/vue3";

export const useUserStore = defineStore("user", {
    state: () => ({
        user: {}, // Изменяем на объект
    }),
    actions: {
        loadUser() {
            const page = usePage();
            const userData = page.props.user;

            const id = userData.id;
            const first_name = userData.first_name;
            const last_name = userData.last_name;
            const nickname = userData.nickname;
            const email = userData.email;
            const img = userData.img;
            const status = userData.status;
        },
    },
});
