import { ref } from 'vue';
import { usePage } from '@inertiajs/vue3';

export function useAuth() {
    // Reactive reference to auth user
    const page = usePage();
    const auth = ref(page.props.value.auth?.user || null);

    // Check single or multiple roles
    const hasRole = (role) => {
        if (!auth.value?.roles) return false;
        if (Array.isArray(role)) {
            return role.some(r => auth.value.roles.includes(r));
        }
        return auth.value.roles.includes(role);
    };

    // Check if user has any role from array
    const hasAnyRole = (roles) => {
        if (!auth.value?.roles) return false;
        return roles.some(r => auth.value.roles.includes(r));
    };

    // Check single or multiple permissions
    const hasPermission = (perm) => {
        if (!auth.value?.permissions) return false;
        if (Array.isArray(perm)) {
            return perm.some(p => auth.value.permissions.includes(p));
        }
        return auth.value.permissions.includes(perm);
    };

    // User menus
    const menus = ref(auth.value?.menus || []);

    return { auth, hasRole, hasAnyRole, hasPermission, menus };
}
