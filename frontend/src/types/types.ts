interface User {
    id: number;
    email: string;
    name: string;
}

interface LoginCredentials {
    email: string;
    password: string;
}

interface FormCredentials {
    title: string;
    description: string;
}

interface AuthResponse {
    user: User;
    token: string;
}