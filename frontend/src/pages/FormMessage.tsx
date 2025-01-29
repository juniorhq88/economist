import React, { useState } from 'react';
import { useQuery, useMutation } from '@tanstack/react-query';
import { useParams } from 'react-router-dom';
import { useAuthStore } from '../store/authStore';
import axios from 'axios';
import { config } from '../services/config';

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

interface FormData {
  [key: string]: string | File;
}

const FormMessage: React.FC = () => {
  const { id } = useParams<{ id: string }>();
  const [formData, setFormData] = useState<FormData>({});
  const [attachedFile, setAttachedFile] = useState<File | null>(null);
  const token = useAuthStore.getState().token;

  const fetchFields = async () => {
    const { data } = await axios.get(`${config.url}forms/${id}`, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });
    return data.fields;
  };

  const mutation = useMutation({
    mutationFn: async (data: FormData) => {
      const formDataToSend = new FormData();

      // Agregar todos los campos del formulario
      Object.keys(data).forEach(key => {
        formDataToSend.append(key, data[key]);
      });

      // Agregar el archivo adjunto si existe
      if (attachedFile) {
        formDataToSend.append('attached_file', attachedFile);
      }

      return axios.post(`${config.url}forms/${id}/submit`, formDataToSend, {
        headers: {
          Authorization: `Bearer ${token}`,
          'Content-Type': 'multipart/form-data',
        },
      });
    },
    onSuccess: () => {
      alert('Formulario enviado con éxito');
      setFormData({});
      setAttachedFile(null);
    },
    onError: (error) => {
      alert('Error al enviar el formulario: ' + error.message);
    },
  });

  const handleInputChange = (field: FormField, event: React.ChangeEvent<HTMLInputElement>) => {
    const { name, value, files } = event.target;
    if (field.type === 'file' && files) {
      setFormData(prev => ({
        ...prev,
        [name]: files[0]
      }));
    } else {
      setFormData(prev => ({
        ...prev,
        [name]: value
      }));
    }
  };

  const handleFileChange = (event: React.ChangeEvent<HTMLInputElement>) => {
    if (event.target.files && event.target.files[0]) {
      setAttachedFile(event.target.files[0]);
    }
  };

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    mutation.mutate(formData);
  };

  const renderInput = (field: FormField) => {
    const commonProps = {
      name: `field_${field.id}`,
      id: `field_${field.id}`,
      required: field.required === 1,
      onChange: (e: React.ChangeEvent<HTMLInputElement>) => handleInputChange(field, e),
      className: "mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500",
      value: formData[`field_${field.id}`] as string || '',
    };

    switch (field.type) {
      case 'text':
        return <input type="text" {...commonProps} className='w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500' />;
      case 'tel':
        return <input type="tel" {...commonProps} className='w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500' />;
      case 'email':
        return <input type="email" {...commonProps} className='w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500' />;
      case 'number':
        return <input type="number" {...commonProps} className='w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500' />;
      case 'file':
        return <input type="file" {...commonProps} value={undefined} className='w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500' />;
      case 'textarea':
        return (
          <textarea
            {...commonProps}
            className="w-full h-32 px-3 py-2 border border-gray-300 rounded-md resize-none focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
        );
      default:
        return <input type="text" {...commonProps} />;
    }
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
      <h2 className="mb-4 text-2xl font-semibold">Enviar datos</h2>
      <form onSubmit={handleSubmit} className="space-y-6 bg-white p-6">
        <div className="space-y-4">
          <div className="grid grid-cols-1 gap-4">
            {fields?.map((field: FormField) => (
              <div key={field.id} className="space-y-2">
                <label
                  htmlFor={`field_${field.id}`}
                  className="block text-sm font-medium text-gray-700"
                >
                  {field.label}
                  {field.required === 1 && <span className="text-red-500">*</span>}
                </label>
                {renderInput(field)}
              </div>
            ))}

            {/* Input file adicional */}
            <div className="space-y-2">
              <label
                htmlFor="attached_file"
                className="block text-sm font-medium text-gray-700"
              >
                Adjuntar archivo
              </label>
              <input
                type="file"
                id="attached_file"
                onChange={handleFileChange}
                className="mt-1 block w-full text-sm text-gray-500
              file:mr-4 file:py-2 file:px-4
              file:rounded-md file:border-0
              file:text-sm file:font-semibold
              file:bg-blue-50 file:text-blue-700
              hover:file:bg-blue-100"
              />
              {attachedFile && (
                <p className="text-sm text-gray-500">
                  Archivo seleccionado: {attachedFile.name}
                </p>
              )}
            </div>

            <div className="pt-4">
              <button
                type="submit"
                disabled={mutation.isPending}
                className="w-full px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-50"
              >
                {mutation.isPending ? 'Enviando...' : 'Enviar Formulario'}
              </button>
            </div>
          </div>
        </div>
      </form>
    </div>
  );
};

export default FormMessage;