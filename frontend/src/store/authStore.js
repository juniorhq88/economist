import { create } from 'zustand';

const useAuthStore = create((set) => ({
  isAuthenticated: false, // Cambiar a true si el usuario está autenticado
  login: () => set({ isAuthenticated: true }),
  logout: () => set({ isAuthenticated: false }),
}));

export default useAuthStore;
