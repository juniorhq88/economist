import axios from 'axios';

const api = axios.create({
  baseURL: process.env.REACT_APP_API_BASE_URL,
});

export const loginRequest = async (credentials: LoginCredentials): Promise<AuthResponse> => {
  const { data } = await api.post<AuthResponse>('/api/login', credentials);
  return data;
};
