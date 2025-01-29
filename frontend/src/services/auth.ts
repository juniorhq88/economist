import axios from 'axios';
import { useAuthStore } from '../store/authStore';

const api = axios.create({
  baseURL: 'http://127.0.0.1:8088',
});

const token = useAuthStore.getState().token;

export const loginRequest = async (credentials: LoginCredentials): Promise<AuthResponse> => {
  const { data } = await api.post<AuthResponse>('/api/login', credentials);
  return data;
};

export const formRequest = async () => {
  const { data } = await api.get('/api/forms', {
    headers: {
      Authorization: `Bearer ${token}`,
    },
  });
  return data;
};


export const sendForm = async (credentials: FormCredentials) => {
  const { data } = await api.post('/api/forms', credentials, {
    headers: {
      Authorization: `Bearer ${token}`,
    },
  });
  return data;
};