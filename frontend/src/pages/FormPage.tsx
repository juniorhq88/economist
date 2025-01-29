import React from 'react';
import { useQuery } from '@tanstack/react-query';
import axios from 'axios';
import { useAuthStore } from '../store/authStore';
import { useNavigate } from 'react-router-dom';

const fetchForms = async () => {
  const token = useAuthStore.getState().token;
  const { data } = await axios.get('http://127.0.0.1:8088/api/forms', {
    headers: {
      Authorization: `Bearer ${token}`,
    },
  });
  return data;
};

const FormPage: React.FC = () => {
  const { data, isLoading, error } = useQuery({
    queryKey: ['forms'],
    queryFn: fetchForms,
  });
  const navigate = useNavigate();

  const handleCreateForm = () => {
    navigate('/form/create');
  };

  if (isLoading) return <p>Cargando...</p>;
  if (error) return <p>Error al cargar los datos</p>;

  return (
    <div className="overflow-x-auto">
      <button
        className="px-4 py-2 mb-4 text-white bg-blue-500 rounded"
        onClick={handleCreateForm}
      >
        Create Form
      </button>
      <table className="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
        <thead className="bg-gray-100">
          <tr>
            <th className="px-4 py-2 font-semibold text-left border-b">
              Titulo
            </th>
            <th className="px-4 py-2 font-semibold text-left border-b">
              Descripción
            </th>
            <th className="px-4 py-2 font-semibold text-left border-b"></th>
          </tr>
        </thead>
        <tbody>
          {data.map(
            (
              item: {
                title:
                  | string
                  | number
                  | boolean
                  | React.ReactElement<
                      any,
                      string | React.JSXElementConstructor<any>
                    >
                  | Iterable<React.ReactNode>
                  | React.ReactPortal
                  | null
                  | undefined;
                description:
                  | string
                  | number
                  | boolean
                  | React.ReactElement<
                      any,
                      string | React.JSXElementConstructor<any>
                    >
                  | Iterable<React.ReactNode>
                  | React.ReactPortal
                  | null
                  | undefined;
                id:
                  | string
                  | number
                  | boolean
                  | React.ReactElement<
                      any,
                      string | React.JSXElementConstructor<any>
                    >
                  | Iterable<React.ReactNode>
                  | React.ReactPortal
                  | null
                  | undefined;
              },
              index: React.Key | null | undefined,
            ) => (
              <tr key={index} className="border-b hover:bg-gray-50">
                <td className="px-4 py-2">{item.title}</td>
                <td className="px-4 py-2">{item.description}</td>
                <td className="px-4 py-2">
                  <div className="flex gap-2">
                    <button
                      className="px-4 py-2 mb-4 text-white bg-blue-500 rounded"
                      onClick={() => navigate(`/form/${item.id}/field`)}
                    >
                      Agregar campos
                    </button>
                    <button
                      className="px-4 py-2 mb-4 text-white rounded bg-violet-400"
                      onClick={() => navigate(`/form/${item.id}/message`)}
                    >
                      Enviar formulario
                    </button>
                  </div>
                </td>
              </tr>
            ),
          )}
        </tbody>
      </table>
    </div>
  );
};
export default FormPage;
