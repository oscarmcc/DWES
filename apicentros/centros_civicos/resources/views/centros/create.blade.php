<!-- resources/views/centros/create.blade.php -->
@extends('layouts.app')

@section('content')

    <style>
/* Estilos modernos para la página de creación de centros cívicos */
:root {
  --primary: #4f46e5;
  --primary-hover: #4338ca;
  --primary-light: #818cf8;
  --primary-bg: rgba(79, 70, 229, 0.05);
  --secondary: #10b981;
  --secondary-hover: #059669;
  --secondary-light: #d1fae5;
  --danger: #ef4444;
  --danger-hover: #dc2626;
  --success: #22c55e;
  --success-hover: #16a34a;
  --background: #f9fafb;
  --card: #ffffff;
  --text: #1f2937;
  --text-light: #6b7280;
  --border: #e5e7eb;
  --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
  --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
  --shadow-md: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
  --shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
  --modal-overlay: rgba(0, 0, 0, 0.5);
  --radius: 0.5rem;
  --radius-sm: 0.375rem;
  --radius-lg: 0.75rem;
  --transition: all 0.2s ease-in-out;
}

body {
  font-family: "Inter", system-ui, -apple-system, sans-serif;
  background-color: var(--background);
  color: var(--text);
  line-height: 1.5;
  margin: 0;
  padding: 0;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 2rem 1rem;
}

/* Dashboard Layout */
.dashboard {
  max-width: 1000px;
  margin: 0 auto;
  padding: 2rem 1rem;
}

.header {
  margin-bottom: 2rem;
  position: relative;
}

.header h1 {
  font-size: 2rem;
  font-weight: 700;
  color: var(--primary);
  margin: 0;
  padding-bottom: 0.75rem;
  border-bottom: 2px solid var(--border);
  position: relative;
}

.header h1::after {
  content: '';
  position: absolute;
  bottom: -2px;
  left: 0;
  width: 100px;
  height: 2px;
  background-color: var(--primary);
}

/* Form Card */
.form-card {
  background-color: var(--card);
  border-radius: var(--radius-lg);
  box-shadow: var(--shadow-md);
  overflow: hidden;
  margin-bottom: 2rem;
  border: 1px solid var(--border);
  transition: var(--transition);
  animation: slideUp 0.4s ease-out forwards;
}

.form-card:hover {
  box-shadow: var(--shadow-lg);
}

.form-header {
  padding: 1.25rem 1.5rem;
  background: linear-gradient(to right, var(--primary), var(--primary-hover));
  color: white;
  font-size: 1.25rem;
  font-weight: 600;
  display: flex;
  align-items: center;
  border-bottom: 1px solid var(--border);
}

.form-body {
  padding: 2rem 1.5rem;
}

/* Form Elements */
.form-group {
  margin-bottom: 1.5rem;
}

.form-label {
  display: block;
  margin-bottom: 0.5rem;
  font-weight: 500;
  color: var(--text);
  font-size: 0.95rem;
}

.form-input {
  width: 100%;
  padding: 0.75rem 1rem;
  border: 1px solid var(--border);
  border-radius: var(--radius-sm);
  font-size: 1rem;
  transition: var(--transition);
  background-color: white;
  color: var(--text);
}

.form-input:focus {
  outline: none;
  border-color: var(--primary-light);
  box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
}

.form-input::placeholder {
  color: var(--text-light);
  opacity: 0.7;
}

.form-actions {
  display: flex;
  justify-content: flex-end;
  gap: 1rem;
  margin-top: 2rem;
  padding-top: 1.5rem;
  border-top: 1px solid var(--border);
}

/* Buttons */
.btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 0.75rem 1.5rem;
  font-weight: 500;
  border-radius: var(--radius);
  transition: var(--transition);
  cursor: pointer;
  text-decoration: none;
  border: none;
  font-size: 0.95rem;
  gap: 0.5rem;
  box-shadow: var(--shadow-sm);
}

.btn svg {
  width: 18px;
  height: 18px;
}

.btn-primary {
  background-color: var(--primary);
  color: white;
  border: 1px solid var(--primary-hover);
}

.btn-primary:hover {
  background-color: var(--primary-hover);
  transform: translateY(-2px);
  box-shadow: var(--shadow);
  text-decoration: none;
}

.btn-success {
  background-color: white;
  color: var(--primary);
  border: 1px solid var(--border);
}

.btn-success:hover {
  background-color: var(--background);
  color: var(--primary-hover);
  transform: translateY(-2px);
  box-shadow: var(--shadow);
  text-decoration: none;
}

.btn-danger {
  background-color: var(--danger);
  color: white;
  border: 1px solid var(--danger-hover);
}

.btn-danger:hover {
  background-color: var(--danger-hover);
  transform: translateY(-2px);
  box-shadow: var(--shadow);
  text-decoration: none;
}

/* Alerts */
.alert {
  padding: 1rem 1.25rem;
  border-radius: var(--radius);
  margin-bottom: 1.5rem;
  display: flex;
  align-items: center;
  gap: 0.75rem;
}

.alert-success {
  background-color: var(--secondary-light);
  color: var(--secondary-hover);
  border-left: 4px solid var(--secondary);
}

/* Animations */
@keyframes slideUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes fadeIn {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}

.animate-fade-in {
  animation: fadeIn 0.3s ease-out forwards;
}

/* Responsive */
@media (max-width: 768px) {
  .dashboard {
    padding: 1.5rem 1rem;
  }
  
  .form-actions {
    flex-direction: column-reverse;
    gap: 0.75rem;
  }
  
  .btn {
    width: 100%;
    justify-content: center;
  }
  
  .form-header {
    padding: 1rem;
    font-size: 1.1rem;
  }
  
  .form-body {
    padding: 1.5rem 1rem;
  }
  
  .header h1 {
    font-size: 1.75rem;
  }
}

@media (max-width: 480px) {
  .dashboard {
    padding: 1rem 0.75rem;
  }
  
  .header h1 {
    font-size: 1.5rem;
  }
  
  .form-input {
    padding: 0.65rem 0.85rem;
  }
}

/* Focus styles for accessibility */
:focus {
  outline: 2px solid var(--primary-light);
  outline-offset: 2px;
}

/* Custom focus styles for form elements */
.form-input:focus-visible {
  outline: 2px solid var(--primary-light);
  outline-offset: 0;
  border-color: var(--primary);
}

/* Hover effect for form card */
.form-card {
  position: relative;
  overflow: hidden;
}

.form-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 4px;
  background: linear-gradient(to right, var(--primary), var(--primary-light));
  transform: scaleX(0);
  transform-origin: left;
  transition: transform 0.3s ease;
}

.form-card:hover::before {
  transform: scaleX(1);
}
    </style>

<div class="dashboard">
        <div class="header">
            <h1>Crear Centro Cívico</h1>
        </div>
        
        <div class="form-card">
            <div class="form-header">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display: inline-block; vertical-align: middle; margin-right: 0.5rem;">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Nuevo centro cívico
            </div>
            
            <div class="form-body">
                <form action="{{ route('centros.store') }}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label for="nombre" class="form-label">Nombre del centro</label>
                        <input type="text" id="nombre" name="nombre" placeholder="Ingrese el nombre del centro" class="form-input" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="text" id="direccion" name="direccion" placeholder="Ingrese la dirección" class="form-input" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" id="telefono" name="telefono" placeholder="Ingrese el teléfono de contacto" class="form-input">
                    </div>
                    
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" placeholder="Ingrese el email de contacto" class="form-input" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="horario" class="form-label">Horario</label>
                        <input type="text" id="horario" name="horario" placeholder="Ej: Lunes a Viernes de 9:00 a 18:00" class="form-input" required>
                    </div>
                    
                    <div class="form-actions">
                        <a href="{{ route('centros.index') }}" class="btn btn-success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="19" y1="12" x2="5" y2="12"></line>
                                <polyline points="12 19 5 12 12 5"></polyline>
                            </svg>
                            Volver al listado
                        </a>
                        
                        <button type="submit" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                                <polyline points="17 21 17 13 7 13 7 21"></polyline>
                                <polyline points="7 3 7 8 15 8"></polyline>
                            </svg>
                            Guardar centro
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

