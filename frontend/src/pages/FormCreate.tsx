import React, { useState } from 'react';
import Breadcrumb from '../components/Breadcrumbs/Breadcrumb';
import { sendForm } from '../services/auth';
import { useNavigate } from 'react-router-dom';
import { useAuthStore } from '../store/authStore';

interface FormData {
  user_id: number;
  title: string;
  description: string;
}

const FormCreate: React.FC = () => {
  const navigate = useNavigate();
  const userId = useAuthStore.getState().user?.id ?? 0;
  const [formData, setFormData] = useState<FormData>({
    user_id: userId,
    title: '',
    description: '',
  });

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();

    try {
      // Guardar el formulario
      sendForm(formData);

      // Mostrar mensaje de éxito (opcional)
      alert('Formulario guardado exitosamente');

      // Redirigir al listado
      navigate('/form'); // Ajusta la ruta según tu aplicación
    } catch (error) {
      console.error('Error al guardar:', error);
      alert('Error al guardar el formulario');
    }
  };

  const handleChange = (
    e: React.ChangeEvent<HTMLInputElement | HTMLTextAreaElement>,
  ) => {
    const { name, value } = e.target;
    setFormData((prev) => ({
      ...prev,
      [name]: value,
    }));
  };

  return (
    <>
      <Breadcrumb pageName="Crear formulario" />

      <div className="grid grid-cols-1 gap-9 sm:grid-cols-1">
        <div className="flex flex-col gap-9">
          {/* <!-- Contact Form --> */}
          <div className="bg-white border rounded-sm border-stroke shadow-default dark:border-strokedark dark:bg-boxdark">
            <form onSubmit={handleSubmit}>
              <div className="p-6.5">
                <div className="mb-4.5 flex flex-col gap-6 xl:flex-col">
                  <div className="mb-4.5">
                    <label className="mb-2.5 block text-black dark:text-white">
                      Titulo
                    </label>
                    <input
                      type="text"
                      id="title"
                      name="title"
                      placeholder="Escriba un titulo"
                      value={formData.title}
                      onChange={handleChange}
                      required
                      className="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                    />
                  </div>

                  <div className="mb-4.5">
                    <label className="mb-2.5 block text-black dark:text-white">
                      Descripción
                    </label>
                    <textarea
                      id="description"
                      name="description"
                      value={formData.description}
                      onChange={handleChange}
                      placeholder="Ingrese la descripción"
                      required
                      className="w-full h-32 px-3 py-2 border border-gray-300 rounded-md resize-none focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    />
                  </div>
                </div>

                <button className="flex justify-center w-full p-3 font-medium rounded bg-primary text-gray hover:bg-opacity-90">
                  Guardar
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </>
  );
};

export default FormCreate;
