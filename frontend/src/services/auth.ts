import axios from 'axios';

const api = axios.create({
  baseURL: 'http://127.0.0.1:8088',
});

export const loginRequest = async (credentials: LoginCredentials): Promise<AuthResponse> => {
  const { data } = await api.post<AuthResponse>('/api/login', credentials);
  return data;
};
