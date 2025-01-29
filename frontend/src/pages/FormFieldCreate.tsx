import React from 'react';
import Breadcrumb from '../components/Breadcrumbs/Breadcrumb';
import DynamicForm from '../components/DynamicForm';
import { useParams } from 'react-router-dom';

const FormFieldCreate: React.FC = () => {
  const { id } = useParams<{ id: string }>();

  return (
    <>
      <Breadcrumb pageName="Agregar campos al formulario" />
      <h2>Formulario {id}</h2>
      <DynamicForm />
    </>
  );
};

export default FormFieldCreate;
