import React, { useState } from 'react';
import { sendFormFields } from '../services/auth';
import { useParams } from 'react-router-dom';

interface Field {
  id: string;
  name: string;
  type: string;
  label: string;
  required: boolean;
  order: number;
}

interface FormValues {
  [key: string]: string;
}

const DynamicForm = () => {
  const [fields, setFields] = useState<Field[]>([]);
  const [formValues, setFormValues] = useState<FormValues>({});
  const [newField, setNewField] = useState({
    name: '',
    type: 'text',
    label: '',
    required: true,
  });

   const { id } = useParams<{ id: string }>();

  const addField = () => {
    if (newField.name.trim()) {
      const fieldToAdd = {
        id: Date.now().toString(),
        name: newField.name.trim(),
        type: newField.type,
        label: newField.label.trim() || newField.name.trim(),
        required: newField.required,
        order: fields.length + 1,
      };
      setFields([...fields, fieldToAdd]);
      setFormValues({
        ...formValues,
        [newField.name]: '',
      });
      setNewField({
        name: '',
        type: 'text',
        label: '',
        required: true,
      });
    }
  };

  const removeField = (fieldId: string) => {
    const fieldToRemove = fields.find((f) => f.id === fieldId);
    if (fieldToRemove) {
      const { [fieldToRemove.name]: _, ...restValues } = formValues;
      setFormValues(restValues);
      
      // Reorder remaining fields
      const updatedFields = fields
        .filter((f) => f.id !== fieldId)
        .map((field, index) => ({
          ...field,
          order: index + 1,
        }));
      
      setFields(updatedFields);
    }
  };

  const handleInputChange = (name: string, value: string) => {
    setFormValues({
      ...formValues,
      [name]: value,
    });
  };

  const resetForm = () => {
    setFields([]);
    setFormValues({});
    setNewField({
      name: '',
      type: 'text',
      label: '',
      required: true,
    });
  };

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();

    const formData = {
      fields: fields.map(field => ({
        form_id: id,
        name: field.name,
        type: field.type,
        label: field.label,
        required: field.required,
        order: field.order,
      })),
      values: formValues,
    };
    
    console.log('Form Data:', formData);
    sendFormFields(formData);

    resetForm();

    alert('Campos guardados exitosamente');
  };

  return (
    <div className="w-full max-w-2xl p-6 mx-auto bg-white rounded-lg shadow-md">
      {/* Campo nuevo section */}
      <div className="p-4 mb-8 rounded-lg bg-gray-50">
        <h3 className="mb-4 text-lg font-semibold text-gray-700">
          Agregar Nuevo Campo
        </h3>
        <div className="space-y-4">
          <div className="grid grid-cols-2 gap-4">
            <input
              type="text"
              value={newField.name}
              onChange={(e) => setNewField({...newField, name: e.target.value})}
              placeholder="Nombre del campo"
              className="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
            <input
              type="text"
              value={newField.label}
              onChange={(e) => setNewField({...newField, label: e.target.value})}
              placeholder="Etiqueta del campo"
              className="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
          </div>
          
          <div className="flex gap-4">
            <select
              value={newField.type}
              onChange={(e) => setNewField({...newField, type: e.target.value})}
              className="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
              <option value="text">Texto</option>
              <option value="number">Número</option>
              <option value="tel">Teléfono</option>
              <option value="email">Email</option>
              <option value="textarea">Área de texto</option>
            </select>
            
            <div className="flex items-center">
              <input
                type="checkbox"
                checked={newField.required}
                onChange={(e) => setNewField({...newField, required: e.target.checked})}
                className="w-4 h-4 mr-2 border-gray-300 rounded focus:ring-blue-500"
              />
              <span className="text-sm text-gray-700">Obligatorio</span>
            </div>
            
            <button
              onClick={addField}
              type="button"
              className="px-4 py-2 ml-auto text-white bg-green-800 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500"
            >
              Agregar Campo
            </button>
          </div>
        </div>
      </div>

      {/* Dynamic form section */}
      <form onSubmit={handleSubmit} className="space-y-6">
        {fields.map((field) => (
          <div key={field.id} className="relative group">
            <label className="block mb-1 text-sm font-medium text-gray-700">
              {field.label} {field.required && <span className="text-red-500">*</span>}
            </label>
            {field.type === 'textarea' ? (
              <textarea
                value={formValues[field.name] || ''}
                onChange={(e) => handleInputChange(field.name, e.target.value)}
                //required={field.required}
                className="w-full h-32 px-3 py-2 border border-gray-300 rounded-md resize-none focus:outline-none focus:ring-2 focus:ring-blue-500"
              />
            ) : (
              <input
                type={field.type}
                value={formValues[field.name] || ''}
                onChange={(e) => handleInputChange(field.name, e.target.value)}
                //required={field.required}
                className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
              />
            )}
            <button
              type="button"
              onClick={() => removeField(field.id)}
              className="absolute flex items-center justify-center w-6 h-6 text-white transition-opacity bg-red-500 rounded-full opacity-0 -right-2 -top-2 group-hover:opacity-100"
            >
              ×
            </button>
          </div>
        ))}

        {fields.length > 0 && (
          <button
            type="submit"
            className="w-full px-4 py-2 text-white transition-colors duration-200 bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
          >
            Guardar campos
          </button>
        )}
      </form>
    </div>
  );
};

export default DynamicForm;