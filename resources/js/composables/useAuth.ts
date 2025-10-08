import { ref, computed, type Ref } from 'vue'
import { usePage } from '@inertiajs/vue3'

interface AuthUser {
  id?: number
  name?: string
  email?: string
  roles?: string[]
  permissions?: string[]
  menus?: any[]
}

export function useAuth() {
  // Reactive reference to auth user
  const page = usePage<{ auth?: AuthUser }>()
  const auth: Ref<AuthUser | null> = ref(page.props.value.auth || null)

  // Computed helper to check a single or multiple roles
  const hasRole = (role: string | string[]): boolean => {
    if (!auth.value?.roles) return false
    if (Array.isArray(role)) return role.some(r => auth.value?.roles?.includes(r))
    return auth.value.roles.includes(role)
  }

  // Computed helper to check any role from an array
  const hasAnyRole = (roles: string[]): boolean => {
    if (!auth.value?.roles) return false
    return roles.some(r => auth.value?.roles?.includes(r))
  }

  // Computed helper to check permission
  const hasPermission = (perm: string | string[]): boolean => {
    if (!auth.value?.permissions) return false
    if (Array.isArray(perm)) return perm.some(p => auth.value?.permissions?.includes(p))
    return auth.value.permissions.includes(perm)
  }

  const menus: Ref<any[]> = ref(auth.value?.menus || [])

  return { auth, hasRole, hasAnyRole, hasPermission, menus }
}
