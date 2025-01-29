import React from 'react';
import { useQuery } from '@tanstack/react-query';
import { useParams } from 'react-router-dom';
import { useAuthStore } from '../store/authStore';
import axios from 'axios';

interface Field {
  id: number;
  name: string;
  type: string;
  fields: FormField;
}

interface FormField {
  id: number;
  form_id: number;
  label: string;
  type: string;
  value: string;
  required: number;
  order: number;
  file_path: string | null;
}

const FormMessage: React.FC = () => {
  const { id } = useParams<{ id: string }>();

  const fetchFields = async () => {
    const token = useAuthStore.getState().token;
    const { data } = await axios.get(`http://127.0.0.1:8088/api/forms/${id}`, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });
    return data.fields;
  };

  const {
    data: fields,
    isLoading,
    isError,
    error,
  } = useQuery<FormField[], Error>({
    queryKey: ['formFields', id],
    queryFn: fetchFields,
  });

  if (isLoading) {
    return <div className="text-center">Cargando...</div>;
  }

  if (isError) {
    return <div className="text-red-500">{(error as Error).message}</div>;
  }

  return (
    <div className="max-w-4xl p-4 mx-auto">
      <h2 className="mb-4 text-2xl font-semibold">Campos del Formulario</h2>
      <ul className="space-y-2">
        {fields?.map((field: FormField) => (
          <li key={field.id} className="pb-2 border-b">
            <span className="font-semibold">{field.label}</span>
            <span> {field.value}</span>- {field.type}
          </li>
        ))}
      </ul>
    </div>
  );
};

export default FormMessage;
