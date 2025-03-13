<!-- resources/views/centros/create.blade.php -->
@extends('layouts.app')

@section('content')

    <style>
/* Estilos para la página de listado de centros */
:root {
  --primary: #4f46e5;
  --primary-hover: #4338ca;
  --secondary: #10b981;
  --secondary-hover: #059669;
  --danger: #ef4444;
  --danger-hover: #dc2626;
  --background: #f9fafb;
  --card: #ffffff;
  --text: #1f2937;
  --text-light: #6b7280;
  --border: #e5e7eb;
  --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
  --modal-overlay: rgba(0, 0, 0, 0.5);
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

.page-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 2rem;
  border-bottom: 2px solid var(--border);
  padding-bottom: 1rem;
}

.page-title {
  font-size: 1.875rem;
  font-weight: 700;
  color: var(--primary);
  margin: 0;
}

/* Botones */
.btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 0.5rem 1rem;
  font-weight: 500;
  border-radius: 0.375rem;
  transition: all 0.2s;
  cursor: pointer;
  text-decoration: none;
  border: none;
  font-size: 0.875rem;
  gap: 0.5rem;
}

.btn-primary {
  background-color: var(--primary);
  color: white;
}

.btn-primary:hover {
  background-color: var(--primary-hover);
  text-decoration: none;
}

.btn-secondary {
  background-color: white;
  color: var(--text);
  border: 1px solid var(--border);
}

.btn-secondary:hover {
  background-color: var(--background);
  text-decoration: none;
}

.btn-danger {
  background-color: var(--danger);
  color: white;
}

.btn-danger:hover {
  background-color: var(--danger-hover);
  text-decoration: none;
}

.btn-sm {
  padding: 0.25rem 0.5rem;
  font-size: 0.75rem;
}

/* Cuadrícula de tarjetas */
.card-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 1.5rem;
  margin-top: 1.5rem;
}

.card {
  background-color: var(--card);
  border-radius: 0.5rem;
  box-shadow: var(--shadow);
  overflow: hidden;
  transition: transform 0.2s, box-shadow 0.2s;
}

.card:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
}

.card-header {
  padding: 1rem;
  border-bottom: 1px solid var(--border);
  background-color: rgba(79, 70, 229, 0.05);
}

.card-title {
  font-size: 1.25rem;
  font-weight: 600;
  color: var(--primary);
  margin: 0;
}

.card-body {
  padding: 1rem;
}

.card-footer {
  padding: 1rem;
  border-top: 1px solid var(--border);
  display: flex;
  justify-content: flex-end;
  gap: 0.5rem;
}

/* Lista de información */
.info-list {
  margin: 0;
  padding: 0;
  list-style: none;
}

.info-item {
  display: flex;
  margin-bottom: 0.5rem;
}

.info-label {
  font-weight: 500;
  width: 100px;
  flex-shrink: 0;
}

.info-value {
  color: var(--text-light);
}

/* Alerta */
.alert {
  padding: 1rem;
  border-radius: 0.375rem;
  margin-bottom: 1.5rem;
}

.alert-success {
  background-color: #d1fae5;
  color: #065f46;
  border: 1px solid #a7f3d0;
}

/* Estado vacío */
.empty-state {
  text-align: center;
  padding: 3rem 1rem;
  color: var(--text-light);
}

/* Modal de confirmación */
.modal {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: var(--modal-overlay);
  z-index: 1000;
  align-items: center;
  justify-content: center;
  opacity: 0;
  transition: opacity 0.3s ease;
}

.modal-open {
  display: flex;
  opacity: 1;
}

.modal-content {
  background-color: var(--card);
  border-radius: 0.5rem;
  box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
  width: 90%;
  max-width: 500px;
  overflow: hidden;
}

.modal-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem;
  border-bottom: 1px solid var(--border);
  background-color: rgba(79, 70, 229, 0.05);
}

.modal-header h3 {
  margin: 0;
  color: var(--primary);
  font-size: 1.25rem;
}

.modal-close {
  background: transparent;
  border: none;
  font-size: 1.5rem;
  cursor: pointer;
  color: var(--text-light);
  transition: color 0.2s;
}

.modal-close:hover {
  color: var(--danger);
}

.modal-body {
  padding: 1.5rem;
}

.modal-warning {
  color: var(--danger);
  display: flex;
  align-items: center;
  gap: 0.5rem;
  margin-top: 1rem;
  font-size: 0.875rem;
}

.modal-footer {
  display: flex;
  justify-content: flex-end;
  gap: 0.75rem;
  padding: 1rem;
  border-top: 1px solid var(--border);
  background-color: var(--background);
}

.modal-footer .btn-danger {
  background-color: var(--danger);
}

.modal-footer .btn-danger:hover {
  background-color: var(--danger-hover);
}

/* Animaciones */
@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.animate-fade-in {
  animation: fadeIn 0.3s ease-out forwards;
}

/* Responsive */
@media (max-width: 768px) {
  .card-grid {
    grid-template-columns: 1fr;
  }

  .page-header {
    flex-direction: column;
    align-items: flex-start;
    gap: 1rem;
  }

  .btn {
    width: 100%;
  }

  .card-footer {
    flex-direction: column;
  }

  .modal-footer {
    flex-direction: column;
  }
}


    </style>

    <div class="page-header">
        <h1 class="page-title">Centros Cívicos</h1>
        <a href="{{ route('centros.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Crear Nuevo Centro
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success animate-fade-in">
            {{ session('success') }}
        </div>
    @endif

    <div class="card-grid">
        @foreach($centros as $centro)
            <div class="card animate-fade-in" style="animation-delay: {{ $loop->index * 0.05 }}s">
                <div class="card-header">
                    <h2 class="card-title">{{ $centro->nombre }}</h2>
                </div>
                <div class="card-body">
                    <ul class="info-list">
                        <li class="info-item">
                            <span class="info-label"><i class="fas fa-map-marker-alt"></i> Dirección:</span>
                            <span class="info-value">{{ $centro->direccion }}</span>
                        </li>
                        <li class="info-item">
                            <span class="info-label"><i class="fas fa-phone"></i> Teléfono:</span>
                            <span class="info-value">{{ $centro->telefono }}</span>
                        </li>
                        <li class="info-item">
                            <span class="info-label"><i class="fas fa-envelope"></i> Email:</span>
                            <span class="info-value">{{ $centro->email }}</span>
                        </li>
                        <li class="info-item">
                            <span class="info-label"><i class="fas fa-clock"></i> Horario:</span>
                            <span class="info-value">{{ $centro->horario }}</span>
                        </li>
                    </ul>
                </div>
                <div class="card-footer">
                    <a href="{{ route('centros.edit', $centro) }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-edit"></i> Editar
                    </a>
                    <button type="button" class="btn btn-danger btn-sm" onclick="openDeleteModal({{ $centro->id }}, '{{ $centro->nombre }}')">
                        <i class="fas fa-trash"></i> Eliminar
                    </button>
                </div>
            </div>
        @endforeach
    </div>

    @if(count($centros) === 0)
        <div class="empty-state animate-fade-in">
            <p>No hay centros cívicos registrados. ¡Crea uno nuevo!</p>
        </div>
    @endif

    <!-- Modal de confirmación para eliminar -->
    <div id="deleteModal" class="modal">
        <div class="modal-content animate-fade-in">
            <div class="modal-header">
                <h3>Confirmar eliminación</h3>
                <button type="button" class="modal-close" onclick="closeDeleteModal()">&times;</button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que deseas eliminar el centro <strong id="centreName"></strong>?</p>
                <p class="modal-warning"><i class="fas fa-exclamation-triangle"></i> Esta acción no se puede deshacer.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeDeleteModal()">Cancelar</button>
                <form id="deleteForm" action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i> Eliminar
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Funciones para el modal de eliminación
        function openDeleteModal(id, name) {
            document.getElementById('deleteForm').action = "{{ route('centros.destroy', '') }}/" + id;
            document.getElementById('centreName').textContent = name;
            document.getElementById('deleteModal').classList.add('modal-open');
            document.body.style.overflow = 'hidden'; // Prevenir scroll
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.remove('modal-open');
            document.body.style.overflow = ''; // Restaurar scroll
        }

        // Cerrar modal al hacer clic fuera de él
        window.onclick = function(event) {
            const modal = document.getElementById('deleteModal');
            if (event.target === modal) {
                closeDeleteModal();
            }
        }
    </script>
@endsection



