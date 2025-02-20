import { Injectable } from '@angular/core';
import { environment } from '../environments/environments';
import { HttpClient } from '@angular/common/http';
import { Contacto } from '../models/contacto';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ContactoService {
  private baseUrl = environment.baseUrl;
  constructor(private http : HttpClient) {}

  // getContactos
  getContactos():Observable<Contacto[]>{ // Contacto[] devuelve un array
    return this.http.get<Contacto[]>(`${this.baseUrl}contactos/`)
  }

  // Metodo para traer un contacto por id
  getContacto(id:number):Observable<Contacto>{ // Contacto devuelve un objeto
    return this.http.get<Contacto>(`${this.baseUrl}contactos/${id}`)
  }

  // Metodo para agregar un contacto
  agregarContacto(contacto:Contacto){
    return this.http.post(`${this.baseUrl}contactos/`, contacto)
  }

  // Metodo para actualizar un contacto
  editarContacto(contacto:Contacto):Observable<Contacto>{
    return this.http.put<Contacto>(`${this.baseUrl}contactos/`, contacto)
  }
}
