import axios from 'axios';

const api = axios.create({
  baseURL: 'http://economic.test:8088/backend/public',
});

export const loginRequest = async (credentials: LoginCredentials): Promise<AuthResponse> => {
  const { data } = await api.post<AuthResponse>('/api/login', credentials);
  return data;
};
