import axios from 'axios';
import { useAuthStore } from '../store/authStore';
import { config } from './config';

const api = axios.create({
  baseURL: `${config.url}`,
});

const token = useAuthStore.getState().token;

export const loginRequest = async (credentials: LoginCredentials): Promise<AuthResponse> => {
  const { data } = await api.post<AuthResponse>('login', credentials);
  return data;
};

export const formRequest = async () => {
  const { data } = await api.get('forms', {
    headers: {
      Authorization: `Bearer ${token}`,
    },
  });
  return data;
};


export const sendForm = async (credentials: FormCredentials) => {
  const { data } = await api.post('forms', credentials, {
    headers: {
      Authorization: `Bearer ${token}`,
    },
  });
  return data;
};

export const sendFormFields = async (credentials: any) => {
  const { data } = await api.post('form-field', credentials, {
    headers: {
      Authorization: `Bearer ${token}`,
    },
  });
  return data;
};