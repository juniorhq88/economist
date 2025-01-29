import React, { useState } from 'react';

interface Field {
  id: string;
  name: string;
  type: string;
}

interface FormValues {
  [key: string]: string;
}

const DynamicForm = () => {
  const [fields, setFields] = useState<Field[]>([]);
  const [formValues, setFormValues] = useState<FormValues>({});
  const [newFieldName, setNewFieldName] = useState('');
  const [newFieldType, setNewFieldType] = useState('text');

  const addField = () => {
    if (newFieldName.trim()) {
      const newField = {
        id: Date.now().toString(),
        name: newFieldName.trim(),
        type: newFieldType,
      };
      setFields([...fields, newField]);
      setFormValues({
        ...formValues,
        [newFieldName]: '',
      });
      setNewFieldName('');
    }
  };

  const removeField = (fieldId: string) => {
    const fieldToRemove = fields.find((f) => f.id === fieldId);
    if (fieldToRemove) {
      const { [fieldToRemove.name]: _, ...restValues } = formValues;
      setFormValues(restValues);
      setFields(fields.filter((f) => f.id !== fieldId));
    }
  };

  const handleInputChange = (name: string, value: string) => {
    setFormValues({
      ...formValues,
      [name]: value,
    });
  };

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    console.log('Form Values:', formValues);
  };

  return (
    <div className="w-full max-w-2xl p-6 mx-auto bg-white rounded-lg shadow-md">
      {/* Sección para agregar nuevos campos */}
      <div className="p-4 mb-8 rounded-lg bg-gray-50">
        <h3 className="mb-4 text-lg font-semibold text-gray-700">
          Agregar Nuevo Campo
        </h3>
        <div className="flex gap-4">
          <input
            type="text"
            value={newFieldName}
            onChange={(e) => setNewFieldName(e.target.value)}
            placeholder="Nombre del campo"
            className="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
          <select
            value={newFieldType}
            onChange={(e) => setNewFieldType(e.target.value)}
            className="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
          >
            <option value="text">Texto</option>
            <option value="number">Número</option>
            <option value="tel">Teléfono</option>
            <option value="email">Email</option>
            <option value="textarea">Área de texto</option>
          </select>
          <button
            onClick={addField}
            type="button"
            className="px-4 py-2 text-white bg-green-600 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500"
          >
            Agregar Campo
          </button>
        </div>
      </div>

      {/* Formulario con campos dinámicos */}
      <form onSubmit={handleSubmit} className="space-y-6">
        {fields.map((field) => (
          <div key={field.id} className="relative group">
            <label className="block mb-1 text-sm font-medium text-gray-700">
              {field.name}
            </label>
            {field.type === 'textarea' ? (
              <textarea
                value={formValues[field.name] || ''}
                onChange={(e) => handleInputChange(field.name, e.target.value)}
                className="w-full h-32 px-3 py-2 border border-gray-300 rounded-md resize-none focus:outline-none focus:ring-2 focus:ring-blue-500"
              />
            ) : (
              <input
                type={field.type}
                value={formValues[field.name] || ''}
                onChange={(e) => handleInputChange(field.name, e.target.value)}
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
