import { useAuthStore } from '../store/authStore';
import { Navigate } from 'react-router';

interface ProtectedRouteProps {
  children: React.ReactNode;
}

const ProtectedRoute: React.FC<ProtectedRouteProps> = ({ children }) => {
  const user = useAuthStore((state) => state.user);
  
  if (!user) {
    // Redirigir a login si no hay usuario autenticado
    return <Navigate to="/login" replace />;
  }

  // Si está autenticado, renderiza el contenido protegido
  return children;
};

export default ProtectedRoute;
