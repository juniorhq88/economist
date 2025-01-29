import React from 'react';
import Breadcrumb from '../components/Breadcrumbs/Breadcrumb';

import { useParams } from 'react-router-dom';
import axios from 'axios';
import { useAuthStore } from '../store/authStore';
import { useQuery } from '@tanstack/react-query';

const FormMessage: React.FC = () => {
  const { id } = useParams<{ id: string }>();
  const fetchFields = async () => {
    const token = useAuthStore.getState().token;
    const { data } = await axios.get('http://127.0.0.1:8088/api/forms', {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });
    return data;
  };

  const { data, isLoading, error } = useQuery({
    queryKey: ['fields'],
    queryFn: fetchFields,
  });

  if (isLoading) return <p>Cargando...</p>;
  if (error) return <p>Error al cargar los datos</p>;

  return (
    <>
      <Breadcrumb pageName="Agregar campos al formulario" />
      <h2>Enviar mensaje del Formulario {id}</h2>
    </>
  );
};

export default FormMessage;
