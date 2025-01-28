import { useMutation } from '@tanstack/react-query';
import { useAuthStore } from '../store/authStore';
import { loginRequest } from '../services/auth';

export const useLogin = () => {
  const setAuth = useAuthStore((state) => state.setAuth);

  return useMutation({
    mutationFn: loginRequest,
    onSuccess: (data) => {
      setAuth(data.user, data.token);
    },
  });
};