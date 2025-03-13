import { Component, OnInit } from '@angular/core';
import { Contacto } from '../../models/contacto';
import { ContactoService } from '../../services/contacto.service';
import { Router } from '@angular/router';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-contacto-agregar',
  imports: [CommonModule, FormsModule],
  templateUrl: './contacto-agregar.component.html',
  styleUrl: './contacto-agregar.component.css'
})
export class ContactoAgregarComponent implements OnInit {
  contacto: Contacto = {id:0,nombre:'',telefono:'',email:''};
  componente: any;
  constructor(private contactoService:ContactoService,private router:Router){}

  ngOnInit(): void {
    console.log('Componente Creado', this.contacto);
  }

  agregar(){
    console.log('agregando registro');
    this.contactoService.agregarContacto(this.contacto).subscribe(()=>{
      this.router.navigate(['/contactos']);
    });
  }

  cancelar(){
    this.router.navigate(['/contactos']);
  }
}
