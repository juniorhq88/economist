import { useEffect, useState } from 'react';
import { Navigate, Outlet, Route, Routes, useLocation } from 'react-router-dom';
import { QueryClient, QueryClientProvider } from '@tanstack/react-query';

import Loader from './common/Loader';

import DefaultLayout from './layout/DefaultLayout';
import AuthLayout from './layout/AuthLayout';
import Login from './pages/Authentication/Login';
import NotFound from './pages/NotFound';
import Dashboard from './pages/Dashboard/Dashboard';
import FormPage from './pages/FormPage';
import FormCreate from './pages/FormCreate';
import FormFieldCreate from './pages/FormFieldCreate';
import FormMessage from './pages/FormMessage';

function App() {
  const [loading, setLoading] = useState<boolean>(true);
  const { pathname } = useLocation();

  const queryClient = new QueryClient();

  useEffect(() => {
    window.scrollTo(0, 0);
  }, [pathname]);

  useEffect(() => {
    setTimeout(() => setLoading(false), 1000);
  }, []);

  return loading ? (
    <Loader />
  ) : (
    <QueryClientProvider client={queryClient}>
      <Routes>
        <Route path="/" element={<Navigate to="/login" replace />} />
        <Route
          element={
            <AuthLayout>
              <Outlet />
            </AuthLayout>
          }
        >
          <Route path="login" element={<Login />} />
        </Route>
        <Route
          element={
            <DefaultLayout>
              <Outlet />
            </DefaultLayout>
          }
        >
          <Route path="dashboard" element={<Dashboard />} />
          <Route path="form" element={<FormPage />} />
          <Route path="form/create" element={<FormCreate />} />
          <Route path="form/:id/field" element={<FormFieldCreate />} />
          <Route path="form/:id/message" element={<FormMessage />} />
        </Route>
        <Route path="*" element={<NotFound />} />
      </Routes>
    </QueryClientProvider>
  );
}

export default App;
